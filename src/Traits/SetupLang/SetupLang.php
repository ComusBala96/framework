<?php

namespace Orian\Framework\Traits\SetupLang;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

trait SetupLang
{
    public function detectLocale(string $sessionKey = 'site_lang', string $defaultLocale = 'en'): void
    {
        $lang = Session::get($sessionKey);
        if ($lang) {
            App::setLocale($lang);
            Carbon::setLocale($lang);
            return;
        }
        $ip = request()->ip();
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = '103.230.105.22';
        }
        try {
            $response = Http::timeout(2)->get("http://ip-api.com/json/{$ip}");
            $location = $response->json();
            if (isset($location['country']) && $location['country'] === 'Bangladesh') {
                App::setLocale('bn');
                Carbon::setLocale('bn');
            } else {
                App::setLocale($defaultLocale);
                Carbon::setLocale($defaultLocale);
            }
        } catch (\Exception $e) {
            App::setLocale($defaultLocale);
            Carbon::setLocale($defaultLocale);
        }
    }
}
