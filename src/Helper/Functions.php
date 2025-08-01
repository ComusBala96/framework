<?php

function bn_number($number)
{
    $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    return str_replace($en, $bn, $number);
}
function paths()
{
    return [
        'root' => 'storage/uploads/',
        'summernote' => 'storage/uploads/summernote/',
        'jodit' => 'storage/uploads/jodit/',
        'logo' => 'storage/uploads/logo/',
        'user' => 'storage/uploads/user/',
        'news_main' => 'storage/uploads/news/main/',
        'news_images' => 'storage/uploads/news/images/',
        'news_files' => 'storage/uploads/news/file/',
        'gallery_main' => 'storage/uploads/gallery/main/',
        'gallery_images' => 'storage/uploads/gallery/images/',
        'gallery_files' => 'storage/uploads/gallery/file/',
        'video_main' => 'storage/uploads/video/main/',
        'video_thumb' => 'storage/uploads/video/thumb/',
        'poll_image' => 'storage/uploads/news/post/poll/',
        'vote_image' => 'storage/uploads/news/post/vote/',
        'ad_image' => 'storage/uploads/ads/main/',
        'ad_image_additional' => 'storage/uploads/ads/additional/',
        'mail' => 'storage/uploads/mail/attachment/',
        'backup_db' => 'storage/backup/db/',
        'assets' => 'storage/uploads/',
        'backup_assets' => 'storage/backup/assets/',
        'block' => 'storage/uploads/block/',
    ];
}

function oldPaths()
{
    return [
        'block' => 'statics/images/block/images/',
    ];
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
function category_trans($category)
{
    switch (strtolower($category)) {
        case 'breaking':
            return trans('common.category.breaking');
            break;
        case 'latest':
            return trans('common.category.latest');
            break;
        case 'headline':
            return trans('common.category.headline');
            break;
        case 'feature':
            return trans('common.category.feature');
            break;
        case 'trending':
            return trans('common.category.trending');
            break;
        case 'popular':
            return trans('common.category.popular');
            break;
        default:
            return $category;
            break;
    }
}

function get_base64_image($url)
{
    return 'data:image/png;base64,' . base64_encode(file_get_contents($url));
}
