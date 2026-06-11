<?php

namespace Orian\Framework\Services\ICO;

use Illuminate\Http\UploadedFile;
use InvalidArgumentException;
use RuntimeException;
use SplFileInfo;

class ICO
{
    public const DEFAULT_SIZES = [
        [16, 16],
        [32, 32],
        [48, 48],
    ];

    protected array $images = [];
    
    public function __construct(
        string|UploadedFile|SplFileInfo|null $source = null,
        ?array $sizes = null
    ) {
        if ($source !== null) {
            $this->addImage(
                $source,
                $sizes ?? self::DEFAULT_SIZES
            );
        }
    }

    public static function make(
        string|UploadedFile|SplFileInfo|null $source = null,
        ?array $sizes = null
    ): self {
        return new self($source, $sizes);
    }

    public function addImage(
        string|UploadedFile|SplFileInfo $file,
        ?array $sizes = null
    ): self {
        $image = $this->loadImage($file);

        $sizes ??= self::DEFAULT_SIZES;

        foreach ($sizes as $size) {
            [$width, $height] = $size;

            $newImage = imagecreatetruecolor($width, $height);

            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);

            $transparent = imagecolorallocatealpha(
                $newImage,
                0,
                0,
                0,
                127
            );

            imagefill($newImage, 0, 0, $transparent);

            imagecopyresampled(
                $newImage,
                $image,
                0,
                0,
                0,
                0,
                $width,
                $height,
                imagesx($image),
                imagesy($image)
            );

            $this->addImageData($newImage);

            imagedestroy($newImage);
        }

        imagedestroy($image);

        return $this;
    }

    public function save(?string $destination = null): bool
    {
        $destination ??= public_path('favicon.ico');

        $directory = dirname($destination);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        return file_put_contents(
            $destination,
            $this->contents()
        ) !== false;
    }

    public function contents(): string
    {
        return $this->buildIco();
    }

    protected function buildIco(): string
    {
        if (empty($this->images)) {
            throw new RuntimeException(
                'No images available to generate ICO.'
            );
        }

        $header = pack(
            'vvv',
            0,
            1,
            count($this->images)
        );

        $directoryEntries = '';
        $imageData = '';

        $offset = 6 + (16 * count($this->images));

        foreach ($this->images as $image) {
            $directoryEntries .= pack(
                'CCCCvvVV',
                $image['width'] >= 256 ? 0 : $image['width'],
                $image['height'] >= 256 ? 0 : $image['height'],
                0,
                0,
                1,
                32,
                $image['size'],
                $offset
            );

            $imageData .= $image['data'];

            $offset += $image['size'];
        }

        return $header . $directoryEntries . $imageData;
    }

    protected function addImageData($image): void
    {
        $width = imagesx($image);
        $height = imagesy($image);

        $pixelData = [];
        $opacityData = [];

        for ($y = $height - 1; $y >= 0; $y--) {
            $opacityRow = [];
            $bit = 0;
            $byte = 0;

            for ($x = 0; $x < $width; $x++) {
                $color = imagecolorat($image, $x, $y);

                $alpha = ($color >> 24) & 0x7F;
                $alpha = (int) round(
                    (127 - $alpha) * 255 / 127
                );

                $red = ($color >> 16) & 0xFF;
                $green = ($color >> 8) & 0xFF;
                $blue = $color & 0xFF;

                $pixelData[] = pack(
                    'CCCC',
                    $blue,
                    $green,
                    $red,
                    $alpha
                );

                $transparent = $alpha === 0 ? 1 : 0;

                $byte = ($byte << 1) | $transparent;
                $bit++;

                if ($bit === 8) {
                    $opacityRow[] = chr($byte);
                    $bit = 0;
                    $byte = 0;
                }
            }

            if ($bit > 0) {
                $byte <<= (8 - $bit);
                $opacityRow[] = chr($byte);
            }

            while (count($opacityRow) % 4 !== 0) {
                $opacityRow[] = chr(0);
            }

            $opacityData[] = implode('', $opacityRow);
        }

        $bmpHeader = pack(
            'V3v2V6',
            40,
            $width,
            $height * 2,
            1,
            32,
            0,
            0,
            0,
            0,
            0,
            0
        );

        $pixelBlock = implode('', $pixelData);
        $maskBlock = implode('', $opacityData);

        $data = $bmpHeader . $pixelBlock . $maskBlock;

        $this->images[] = [
            'width' => $width,
            'height' => $height,
            'size' => strlen($data),
            'data' => $data,
        ];
    }

    protected function loadImage(
        string|UploadedFile|SplFileInfo $file
    ) {
        $path = $this->resolvePath($file);

        if (! file_exists($path)) {
            throw new InvalidArgumentException(
                "Image not found: {$path}"
            );
        }

        if (! getimagesize($path)) {
            throw new InvalidArgumentException(
                "Invalid image file: {$path}"
            );
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new RuntimeException(
                "Unable to read image: {$path}"
            );
        }

        $image = imagecreatefromstring($contents);

        if (! $image) {
            throw new RuntimeException(
                "Unable to create image resource from: {$path}"
            );
        }

        return $image;
    }

    protected function resolvePath(
        string|UploadedFile|SplFileInfo $file
    ): string {
        return match (true) {
            $file instanceof UploadedFile => $file->getRealPath(),
            $file instanceof SplFileInfo => $file->getRealPath(),
            default => $file,
        };
    }
}
