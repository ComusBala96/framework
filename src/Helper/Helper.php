<?php

namespace Orian\Framework\Helper;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function getFilesRecursively($directory, $prepend)
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile()) {
                $relativePath = $prepend . '/' . ltrim(str_replace($directory, '', $fileInfo->getPathname()), DIRECTORY_SEPARATOR);
                $files[] = $relativePath;
            }
        }

        return $files;
    }

    public static function createDir($dir)
    {
        if (!is_dir(public_path($dir))) {
            File::makeDirectory(public_path($dir), 0777, true, true);
        }
    }

    public static function metaImage()
    {
        return [
            'favicon' => 'favicon.ico',
            'logo' => 'logo.png',
            'logo_dark' => 'logo-dark.png',
            'auth' => 'statics/images/auth.jpg',
            'loader' => 'statics/images/loader.gif',
            'profile' => 'statics/images/profile.png',
            'cover' => 'statics/images/cover.png',
            'qr' => 'statics/images/qr.png',
            'glob' => 'statics/images/glob.png',
            '404' => 'statics/images/404.png',
            'no_data' => 'statics/images/no_data.jpg',
        ];
    }

    public static function createImages($image, $size = [], $path = '', $name = '', $ext = '', $scope = 1, $type = 'variant')
    {
        foreach ($size as $key => $item) {
            $img = Image::make($image)->encode($ext, $scope);
            $img->resize($item['width'], $item['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            if ($type == 'variant') {
                $img->save(public_path($path . $name . '_' . $item['width'] . 'x' . $item['height'] . '.' . $ext));
            } else {
                $img->save(public_path($path . $name . '.' . $ext));
            }
        }
    }

    public static function createRawFiles($file, $size = [], $path = '', $name = '', $ext = '', $type = 'variant')
    {
        if ($type == 'variant') {
            foreach ($size as $key => $item) {
                Storage::put($path . $name . '_' . $item['width'] . 'x' . $item['height'] . '.' . $ext, file_get_contents($file));
            }
        } else {
            Storage::put($path . $name . '.' . $ext, file_get_contents($file));
        }
    }

    public static function deleteFile($file)
    {
        if (File::exists($file)) {
            File::delete($file);
        }
    }

    public static function deleteDirectory($root)
    {
        if (File::exists(public_path($root))) {
            File::deleteDirectory(public_path($root));
        }
    }

    public static function createImageSize($size = [])
    {
        $width = $size['width'];
        $height = $size['height'];
        return '_' . $width . 'x' . $height . '.';
    }

    public static function exceptColumns($table, $except = [])
    {
        $columns = Schema::getColumnListing($table);
        return array_diff($columns, $except);
    }

    public static function isValidUtf8($text): bool
    {
        return mb_detect_encoding($text, 'UTF-8', true) !== false;
    }
}
