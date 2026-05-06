<?php

function trans_number($number)
{
    if (app()->getLocale() == 'bn') {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return  str_replace($en, $bn, $number);
    }
    return $number;
}
function trans_date($date)
{
    $carbon = \Carbon\Carbon::parse($date)->translatedFormat('j F, Y');
    if (app()->getLocale() == 'bn') {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return  str_replace($en, $bn, $carbon);
    }
    return $carbon;
}
function trans_date_time($date)
{
    if (app()->getLocale() === 'bn') {
        $carbon = \Carbon\Carbon::parse($date);
        if ($carbon->hour < 12) {
            $meridiem = 'সকাল';
        } elseif ($carbon->hour < 16) {
            $meridiem = 'দুপুর';
        } elseif ($carbon->hour < 18) {
            $meridiem = 'বিকাল';
        } elseif ($carbon->hour < 20) {
            $meridiem = 'সন্ধ্যা';
        } else {
            $meridiem = 'রাত্রি';
        }
        $date = $carbon->translatedFormat('j F, Y ');
        $time = $carbon->translatedFormat(' h:i');
        $formatted = $date . $meridiem . $time;
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($en, $bn, $formatted);
    }

    return \Carbon\Carbon::parse($date)->translatedFormat('j F, Y h:i A');
}
function getPageDefault($base, $request)
{
    return [
        'base' => $base,
        'item' => null,
        'items' => [],
        'lang' => null,
        'type' => (isset($request->uuid)) ? 'edit' : 'page'
    ];
}

function active($url = '')
{
    if (request()->is($url) || request()->is($url . '/*')) {
        return true;
    }
    return false;
}

function get_base64_image($url)
{
    return 'data:image/png;base64,' . base64_encode(file_get_contents($url));
}

function getFiles(string $directory, string $ext = ''): array
{
    if (!Illuminate\Support\Facades\File::exists($directory)) {
        return [];
    }

    $files = Illuminate\Support\Facades\File::files($directory);

    return collect($files)
        ->map(function ($file) {
            return str_replace(
                '\\',
                '/',
                str_replace(base_path(), '', $file->getPathname())
            );
        })
        ->filter(function ($file) use ($ext) {
            return $ext === '' || str_ends_with($file, $ext);
        })
        ->map(fn($file) => ltrim($file, '/'))
        ->toArray();
}

if (! function_exists('orians_payload')) {
    function orians_payload(): string
    {
        return view('orians::payload')->render();
    }
}