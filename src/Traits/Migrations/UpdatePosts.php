<?php

namespace Orian\Framework\Traits\Migrations;

use App\Models\Menu;
use Webpatser\Uuid\Uuid;
use App\Models\Old\OldPost;
use Illuminate\Support\Facades\DB;
use Orian\Framework\Helper\Helper;
use Illuminate\Support\Facades\File;
use Orian\Framework\Constant\Constant;

trait UpdatePosts
{
    public function UpdatePosts()
    {
        DB::table('news')->truncate();
        $menus = Menu::where('lang', 'en')->pluck('id', 'name')->toArray();
        $postImageSizes = config('config.post_image_size', Constant::defaultPostImageSize());
        $oldImagePath = public_path(oldPaths()['news']);
        $newsImagePath = paths()['news_main'];
        Helper::createDir($newsImagePath);
        File::cleanDirectory($newsImagePath);
        OldPost::with([
            'tags:id,post_id,tag',
            'category:id,name,description,keywords',
            'user:id,username'
        ])->chunk(300, function ($posts) use ($menus, $postImageSizes, $oldImagePath, $newsImagePath) {
            $batch = [];
            foreach ($posts as $key => $item) {
                $imagePath = $oldImagePath . $item->image_big;
                if (empty($item->image_big) || !File::exists($imagePath) || getimagesize($imagePath) === false) {
                    continue;
                }
                if (empty($menus[$item->category->name])) {
                    continue;
                }
                $ext = pathinfo($imagePath, PATHINFO_EXTENSION);
                $imageName = (string) Uuid::generate(4);
                Helper::createImages($imagePath, $postImageSizes, $newsImagePath, $imageName, $ext, 100, 'variant');

                $batch[] = ['uuid' => (string) Uuid::generate(4), 'serial' => $key + 1, 'lang' => 'en', 'type' => $item->post_type, 'title' => $item->title, 'description' => $item->summary, 'keywords' => $item->keywords, 'tags' => implode(',', $item->tags->pluck('tag')->toArray()), 'visibility' => $item->visibility, 'breaking' => $item->is_breaking, 'headline' => $item->is_slider, 'latest' => 1, 'feature' => $item->is_featured, 'popular' => $item->is_recommended, 'trending' => $item->is_recommended, 'public' => $item->is_poll_public, 'optional_url' => $item->optional_url, 'menu_id' => $menus[$item->category->name], 'content' => $item->content, 'image' => $imageName, 'size_sm' => Helper::createImageSize($postImageSizes[0]), 'size_md' => Helper::createImageSize($postImageSizes[1]), 'size_xl' => Helper::createImageSize($postImageSizes[2]), 'ext' => $ext, 'image_url' => $item->image_url, 'image_caption' => $item->image_description, 'author_id' => $item->user_id, 'pending' => 0, 'views' => $item->pageviews, 'created_by' => 1, 'created_at' => $item->created_at, 'updated_at' => now(), ];
                if (count($batch) >= 300) {
                    DB::table('news')->insert($batch);
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table('news')->insert($batch);
            }
        });
    }
}
