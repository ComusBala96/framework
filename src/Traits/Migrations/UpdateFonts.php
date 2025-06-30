<?php

namespace Orian\Framework\Traits\Migrations;

use Webpatser\Uuid\Uuid;
use App\Models\ThemeFont;
use App\Models\Old\OldFont;

trait UpdateFonts
{
    public function UpdateFonts()
    {
        $fonts = ThemeFont::where('lang', 'en')->pluck('name')->toArray();
        $oldFonts = OldFont::whereNotIn('font_name', $fonts)->get();
        $themeFonts = [];
        foreach ($oldFonts as $key => $item) {
            $themeFonts[] = ['uuid' => (string) Uuid::generate(4), 'serial' => $key + 1, 'lang' => 'en', 'name' => $item->font_name, 'family' => $item->font_family, 'url' => $item->font_url, 'created_by' => 1, 'created_at' => $item->created_at, 'updated_at' => now(), ];
            if (count($themeFonts) >= 300) {
                ThemeFont::insert($themeFonts);
                $themeFonts = [];
            }
        }
        if (!empty($themeFonts)) {
            ThemeFont::insert($themeFonts);
        }
    }
}
