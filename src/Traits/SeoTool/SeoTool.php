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
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Homepage');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(config('meta.logo')));
        TwitterCard::setType('Homepage');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
        JsonLd::setDescription($item?->description ?? $item?->title);
    }

    public function generatePageMetaData($item)
    {
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Pages');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(config('meta.logo')));
        TwitterCard::setType('Pages');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
        JsonLd::setDescription($item?->description ?? $item?->title);
    }

    public function generateCategoryMetaData($item)
    {
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Category');
        foreach ($item->news as $key => $news) {
            OpenGraph::addImage($news->image ? url(paths()['news_main'] . $news->image . $news->size_xl . $news->ext) : $news?->image_url);
        }

        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        foreach ($item->news as $key => $news) {
            TwitterCard::addImage($news->image ? url(paths()['news_main'] . $news->image . $news->size_xl . $news->ext) : $news?->image_url);
        }
        TwitterCard::setType('Category');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        foreach ($item->news as $key => $news) {
            JsonLd::addImage($news->image ? url(paths()['news_main'] . $news->image . $news->size_xl . $news->ext) : $news?->image_url);
        }
        JsonLd::setDescription($item?->description ?? $item?->title);
    }

    public function generateGalleryMeta($item)
    {
        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'Gallery');
        OpenGraph::addImage(url(paths()['gallery_main'] . $item->image . $item->size_xl . $item->ext));
        foreach ($item->images as $key => $image) {
            OpenGraph::addImage(url(paths()['gallery_images'] . $image->name . $image->size_xl . $image->ext));
        }
        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage(url(paths()['gallery_main'] . $item->image . $item->size_xl . $item->ext));
        foreach ($item->images as $key => $image) {
            TwitterCard::addImage(url(paths()['gallery_images'] . $image->name . $image->size_xl . $image->ext));
        }
        TwitterCard::setType('Gallery');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(paths()['gallery_main'] . $item->image . $item->size_xl . $item->ext));
        foreach ($item->images as $key => $image) {
            JsonLd::addImage(url(paths()['gallery_images'] . $image->name . $image->size_xl . $image->ext));
        }
        JsonLd::setDescription($item?->description ?? $item?->title);
    }

    public function generateNewsMeta($item)
    {
        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'News');
        OpenGraph::addImage($item->image ? url(paths()['news_main'] . $item->image . $item->size_xl . $item->ext) : $item?->image_url);
        foreach ($item->images as $key => $image) {
            OpenGraph::addImage(url(paths()['news_images'] . $image->name . $image->size_xl . $image->ext));
        }
        TwitterCard::setTitle($item?->title . ' - ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::addImage($item->image ? url(paths()['news_main'] . $item->image . $item->size_xl . $item->ext) : $item?->image_url);
        foreach ($item->images as $key => $image) {
            TwitterCard::addImage(url(paths()['news_images'] . $image->name . $image->size_xl . $image->ext));
        }
        TwitterCard::setType('News');

        JsonLd::setTitle($item?->title . ' - ' . config('meta.app_name'));
        JsonLd::setSite(url()->current());
        JsonLd::addImage($item->image ? url(paths()['news_main'] . $item->image . $item->size_xl . $item->ext) : $item?->image_url);
        foreach ($item->images as $key => $image) {
            JsonLd::addImage(url(paths()['news_images'] . $image->name . $image->size_xl . $image->ext));
        }
        JsonLd::setDescription($item?->description ?? $item?->title);
    }

    public function generateVideoMeta($item)
    {
        SEOMeta::setTitle($item?->title . ' - ' . config('meta.app_name'));
        SEOMeta::setDescription($item?->description ?? $item?->title);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setDescription($item?->description ?? $item?->title);
        OpenGraph::setTitle($item?->title . ' - ' . config('meta.app_name'));
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
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
        JsonLd::setDescription($item?->description ?? $item?->title);
    }
}
