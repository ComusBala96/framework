<?php

namespace Orian\Framework\Traits\SeoTool;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

trait SeoTool
{
    public function generateHomeMetaData($item)
    {
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Homepage');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(config('meta.logo')));
        TwitterCard::setType('Homepage');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
    }

    public function generatePageMetaData($item)
    {
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Pages');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(config('meta.logo')));
        TwitterCard::setType('Pages');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
    }

    public function generateCategoryMetaData($item)
    {
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Category');

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('Category');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());

        foreach ($item->news as $key => $news) {
            if (empty($news?->meta_image)) {
                $image = url(paths()['news_main'] . $news->image . $news->size_xl . $news->ext);
            } else {
                $image = url(paths()['meta_image'] . $news->meta_image . $news->size_xl . $news->ext);
            }
            OpenGraph::addImage($image ? $image : $news?->image_url);
            TwitterCard::addImage($image ? $image : $news?->image_url);
            JsonLd::addImage($image ? $image : $news?->image_url);
        }
    }

    public function generateGalleryMeta($item)
    {
        $image = url(paths()['gallery_main'] . $item->image . $item->size_xl . $item->ext);

        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Gallery');
        OpenGraph::addImage($image);

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage($image);
        TwitterCard::setType('Gallery');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());
        JsonLd::addImage($image);

        foreach ($item->images as $key => $image) {
            $images = url(paths()['gallery_images'] . $image->name . $image->size_xl . $image->ext);
            OpenGraph::addImage($images);
            TwitterCard::addImage($images);
            JsonLd::addImage($images);
        }
    }

    public function generateNewsMeta($item)
    {
        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'News');
        if (empty($item?->meta_image)) {
            $image = url(paths()['news_main'] . $item->image . $item->size_xl . $item->ext);
        } else {
            $image = url(paths()['meta_image'] . $item->meta_image . $item->size_xl . $item->ext);
        }
        OpenGraph::addImage($image ? $image : $item?->image_url);

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('News');
        TwitterCard::addImage($image ? $image : $item?->image_url);

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());
        JsonLd::addImage($image ? $image : $item?->image_url);
    }

    public function generatePollMeta($item)
    {
        $image = url(paths()['poll_image'] . $item->image . $item->size_xl . $item->ext);

        SEOMeta::setTitle($item?->question . ' - ' . config('meta.app_name'));
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->question . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Poll');
        OpenGraph::addImage($image);

        TwitterCard::setTitle($item?->question . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('Poll');
        TwitterCard::addImage($image);

        JsonLd::setTitle($item?->question . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        JsonLd::addImage($image);
    }

    public function generateVideoMeta($item)
    {
        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription(strip_tags($item?->description));
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setDescription(strip_tags($item?->description));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Video');
        OpenGraph::addImage(url(config('meta.logo')));
        OpenGraph::addVideo($item->url ? $item->url : url(paths()['video_main'] . $item->video));

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(config('meta.logo')));
        TwitterCard::setType('Video');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setDescription(strip_tags($item?->description));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
    }
}
