<?php

namespace Orian\Framework\Traits\DomDocument;

use DOMDocument;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;
use Orian\Framework\Helper\Helper;

trait MakeDocument
{
    public function createDomContent($content, $type = '')
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $content = '<?xml encoding="utf-8" ?>' . $content;
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        $path = paths()['jodit'];
        Helper::createDir($path);
        $ext = 'jpg';
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (Str::startsWith($src, 'data:image')) {
                $baseImg = base64_decode(explode(',', explode(';', $src)[1])[1]);
                $name = (string)Uuid::generate(4);
                file_put_contents(public_path($path . $name . '.' . $ext), $baseImg);
                $img->setAttribute('src', url($path . $name . '.' . $ext));
                $img->setAttribute('alt', $name . '.' . $ext);
                if ($type === 'pdf') {
                    $img->setAttribute('data-style', json_encode(['width' => 150, 'height' => 120, 'alignment' => 'center']));
                    $img->setAttribute('name', Str::random(6));
                    $img->setAttribute('class', 'os-pdf-image');
                }
            }
        }

        return $dom->saveHTML();
    }

    public function updateDomContent($content, $type = '')
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $content = '<?xml encoding="UTF-8">' . $content;
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        $path = paths()['jodit'];
        Helper::createDir($path);
        $ext = 'jpg';
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'data:image/') === 0) {
                $baseImg = base64_decode(explode(',', explode(';', $src)[1])[1]);
                $name = (string)Uuid::generate(4);
                file_put_contents(public_path($path . $name . '.' . $ext), $baseImg);
                $img->setAttribute('src', url($path . $name . '.' . $ext));
                $img->setAttribute('alt', $name . '.' . $ext);
                if ($type === 'pdf') {
                    $img->setAttribute('data-style', json_encode(['width' => 150, 'height' => 120, 'alignment' => 'center']));
                    $img->setAttribute('name', Str::random(6));
                    $img->setAttribute('class', 'os-pdf-image');
                }
            }
        }

        return $dom->saveHTML();
    }
}
