<?php

namespace Orian\Framework\Traits\SeoTool;

use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

trait SeoTool
{
    public function generateHomeMetaData($item)
    {
        $locale = app()->getLocale();
        $demoDescription = app()->getLocale() == 'en' ? config('meta.app_name') . ', English news, Asia news, latest news' : config('meta.app_name') . ', বাংলা সংবাদ, এশিয়া নিউজ, সর্বশেষ খবর';
        $description = Str::limit(strip_tags($item->description ?: $demoDescription), 160);
        SEOMeta::setDescription($description ?? $demoDescription);
        SEOMeta::setKeywords($item?->keywords ?? $demoDescription);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle(config('meta.app_name') . ' | ' . $item?->title);
        OpenGraph::setDescription($description ?? $demoDescription);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle(config('meta.app_name') . ' | ' . $item?->title);
        TwitterCard::setDescription($description ?? $demoDescription);
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('summary_large_image');
        TwitterCard::setImage(url(config('meta.logo')));

        JsonLd::setType('website');
        JsonLd::setTitle(config('meta.app_name') . ' | ' . $item?->title);
        JsonLd::setDescription($description ?? $demoDescription);
        JsonLd::setSite(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
    }
    public function generateCategoryMetaData($item)
    {
        $locale = app()->getLocale();
        $title = category_trans(ucfirst($item?->title));
        $demoDescription = $locale == 'en' ? 'Latest ' . $title . ' news from Bangladesh and the world on ' . config('meta.app_name') . '.' : 'বাংলাদেশ ও বিশ্বের ' . $title . ' সংবাদ পড়ুন ' . config('meta.app_name') . '।';
        $description = Str::limit(strip_tags($item->description ?: $demoDescription), 160);
        SEOMeta::setDescription($description ?? $demoDescription);
        SEOMeta::setKeywords($item?->keywords ?? $demoDescription);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title . ' | ' . config('meta.app_name'));
        OpenGraph::setDescription($description ?? $demoDescription);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');

        TwitterCard::setTitle($title . ' | ' . config('meta.app_name'));
        TwitterCard::setDescription($description ?? $demoDescription);
        TwitterCard::setSite(config('meta.twitter', '@lensasia.net'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title . ' | ' . config('meta.app_name'));
        JsonLd::setDescription($description ?? $demoDescription);
        JsonLd::setSite(url()->current());
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        foreach ($item->news->take(1) as $key => $news) {
            if (empty($news?->meta_image)) {
                $image = url(paths()['news_main'] . $news->image . $news->size_xl . $news->ext);
            } else {
                $image = url(paths()['meta_image'] . $news->meta_image . $news->size_xl . $news->ext);
            }
            OpenGraph::addImage($image ? $image : $news?->image_url);
            TwitterCard::setImage($image ? $image : $news?->image_url);
            JsonLd::addImage($image ? $image : $news?->image_url);
        }
    }
    public function generateNewsMeta($item)
    {
        $description = Str::limit(strip_tags($item->description), 160);
        $locale = app()->getLocale();
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($item->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        $image = empty($item->meta_image)
            ? url(paths()['news_main'] . $item->image . $item->size_xl . $item->ext)
            : url(paths()['meta_image'] . $item->meta_image . $item->size_xl . $item->ext);

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($item->title . ' | ' . config('meta.app_name'));
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage($image);

        TwitterCard::setTitle($item->title . ' | ' . config('meta.app_name'));
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('summary_large_image');
        TwitterCard::setImage($image);

        JsonLd::setType('NewsArticle');
        JsonLd::addValue('@id', url()->current());
        JsonLd::addValue('headline', $item->title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addImage($image);
        JsonLd::addValue('datePublished', optional($item->published_at ?: $item->created_at)?->toIso8601String());
        JsonLd::addValue('dateModified', optional($item->updated_at ?: $item->published_at ?: $item->created_at)?->toIso8601String());
        JsonLd::addValue('mainEntityOfPage', ['@type' => 'WebPage', '@id'   => url()->current(),]);
        JsonLd::addValue('author', ['@type' => 'Organization', 'name'  => config('meta.app_name'), "url"   => url('/'),]);
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('publisher', ['@type' => 'Organization', 'name'  => config('meta.app_name'), 'logo'  => ['@type'  => 'ImageObject', 'url'    => url(config('meta.logo')), 'width'  => 600, 'height' => 60,],]);
    }
    public function generateSearchMetaData()
    {
        $locale = app()->getLocale();
        $appName = config('meta.app_name');
        $demoDescription = $locale == 'en' ? $appName . " latest news search." : $appName . " সর্বশেষ সংবাদ অনুসন্ধান করুন।";
        $title = $locale == 'en' ? "Search | {$appName}" : "অনুসন্ধান | {$appName}";
        SEOMeta::setDescription($demoDescription);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($demoDescription);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($demoDescription);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage(url(config('meta.logo')));
        TwitterCard::setType('summary');

        JsonLd::setType('SearchResultsPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($demoDescription);
        JsonLd::setUrl(url()->current());
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateArchiveMetaData()
    {
        $appName = config('meta.app_name');
        $locale = app()->getLocale();
        $title = $locale === 'en'
            ? "Archive | {$appName}"
            : "আর্কাইভ | {$appName}";
        $description = $locale === 'en'
            ? "{$appName} archived news collection."
            : "{$appName} সংরক্ষিত সংবাদ আর্কাইভ।";

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage(url(config('meta.logo')));
        TwitterCard::setType('summary');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateContactMetaData()
    {
        $appName = config('meta.app_name');
        $locale = app()->getLocale();
        $title = $locale === 'en'
            ? "Contact | {$appName}"
            : "যোগাযোগ | {$appName}";
        $description = $locale === 'en'
            ? "Contact {$appName} for news tips, feedback, and advertising inquiries."
            : "{$appName}-এর সঙ্গে যোগাযোগ করুন। সংবাদ, মতামত ও বিজ্ঞাপন সংক্রান্ত তথ্যের জন্য আমাদের সাথে যোগাযোগ করুন।";

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName($appName);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage(url(config('meta.logo')));
        TwitterCard::setType('summary');

        JsonLd::setType('ContactPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('about', ['@type' => 'Organization', 'name' => $appName, 'url' => url('/'), 'logo' => url(config('meta.logo')),]);
    }

    public function generatePageMetaData($item)
    {
        $locale = app()->getLocale();
        $appName = config('meta.app_name');
        $title = trim(($item->title ?? '') . ' | ' . $appName);
        $description = Str::limit(strip_tags($item->description ?: $appName), 160);
        $keywords = $item->keywords ?? '';

        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName($appName);
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setImage(url(config('meta.logo')));
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('WebPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addImage(url(config('meta.logo')));
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('about', ['@type' => 'Organization', 'name' => $appName, 'url' => url('/'), 'logo' => url(config('meta.logo')),]);
    }
    public function generatePollsMeta()
    {
        $locale = app()->getLocale();
        $title = $locale === 'en'
            ? 'Polls | ' . config('meta.app_name')
            : 'জরিপ | ' . config('meta.app_name');
        $description = $locale === 'en'
            ? 'Latest polls and surveys on various topics. Participate in our polls and share your opinions.'
            : 'বিভিন্ন বিষয়ে সর্বশেষ জরিপ এবং সমীক্ষা। আমাদের জরিপে অংশগ্রহণ করুন এবং আপনার মতামত শেয়ার করুন।';

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage(url(config('meta.logo')));

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setImage(url(config('meta.logo')));
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generatePollMeta($item)
    {
        $image = url(paths()['poll_image'] . $item->image . $item->size_xl . $item->ext);
        $locale = app()->getLocale();
        $appName = config('meta.app_name');
        $title = $item->question . ' | ' . $appName;
        $description = $locale === 'en' ? "Share your opinion in this poll: " . $item->question : "এই জরিপে আপনার মতামত দিন: " . $item->question;

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage($image);
        OpenGraph::setSiteName($appName);

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('summary_large_image');
        TwitterCard::addImage($image);

        JsonLd::setType('Question');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addImage($image);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('author', [
            '@type' => 'Organization',
            'name' => $appName,
            'url' => url('/')
        ]);
        if (!empty($item->poll_options)) {
            $answers = [];
            foreach ($item->poll_options as $opt) {
                $answers[] = ['@type' => 'Answer', 'text' => $opt->option];
            }
            JsonLd::addValue('suggestedAnswer', $answers);
        }
    }
    public function generateGalleriesMeta()
    {
        $locale = app()->getLocale();

        $title = $locale === 'en'
            ? 'Galleries | ' . config('meta.app_name')
            : 'গ্যালারি | ' . config('meta.app_name');

        $description = $locale === 'en'
            ? 'Explore the latest galleries of photos and media. Enjoy and share your favorite images.'
            : 'সর্বশেষ ফটো ও মিডিয়া গ্যালারি দেখুন। আপনার প্রিয় ছবি উপভোগ করুন এবং শেয়ার করুন।';

        $url = url()->current();
        $logo = url(config('meta.logo'));
        $twitter = config('meta.twitter', '@lensasiabangla');

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage($logo);

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite($twitter);
        TwitterCard::setImage($logo);
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl($url);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateGalleriesTagMeta($tag)
    {
        $locale = app()->getLocale();

        $title = $tag . ' | ' . config('meta.app_name');

        $description = $locale === 'en'
            ? 'Explore the latest galleries of photos and media. Enjoy and share your favorite images.'
            : 'সর্বশেষ ফটো ও মিডিয়া গ্যালারি দেখুন। আপনার প্রিয় ছবি উপভোগ করুন এবং শেয়ার করুন।';

        $url = url()->current();
        $logo = url(config('meta.logo'));
        $twitter = config('meta.twitter', '@lensasiabangla');

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage($logo);

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite($twitter);
        TwitterCard::setImage($logo);
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl($url);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateGalleryMeta($item)
    {
        $mainImage = url(paths()['gallery_main'] . $item->image . $item->size_xl . $item->ext);
        $locale = app()->getLocale();
        $description = Str::limit(strip_tags($item->description), 160);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle($item?->title . ' | ' . config('meta.app_name'));
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'image_gallery');
        OpenGraph::addImage($mainImage);

        foreach ($item->images->take(5) as $img) {
            $imgUrl = url(paths()['gallery_images'] . $img->name . $img->size_xl . $img->ext);
            OpenGraph::addImage($imgUrl);
        }

        TwitterCard::setTitle($item?->title . ' | ' . config('meta.app_name'));
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('summary_large_image');

        if ($item->images->isNotEmpty()) {
            $firstImg = $item->images->first();
            $twitterImg = url(paths()['gallery_images'] . $firstImg->name . $firstImg->size_xl . $firstImg->ext);
            TwitterCard::setImage($twitterImg);
        } else {
            TwitterCard::setImage($mainImage);
        }

        JsonLd::setType('ImageGallery');
        JsonLd::setTitle($item?->title . ' | ' . config('meta.app_name'));
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addImage($mainImage);

        foreach ($item->images->take(5) as $img) {
            $imgUrl = url(paths()['gallery_images'] . $img->name . $img->size_xl . $img->ext);
            JsonLd::addImage($imgUrl);
        }
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateVideosMeta()
    {
        $locale = app()->getLocale();

        $title = $locale === 'en'
            ? 'Videos | ' . config('meta.app_name')
            : 'ভিডিও | ' . config('meta.app_name');

        $description = $locale === 'en'
            ? 'Explore the latest videos of photos and media. Enjoy and share your favorite videos.'
            : 'সর্বশেষ ফটো ও মিডিয়া ভিডিও দেখুন। আপনার প্রিয় ভিডিওগুলি উপভোগ করুন এবং শেয়ার করুন।';

        $url = url()->current();
        $logo = url(config('meta.logo'));
        $twitter = config('meta.twitter', '@lensasiabangla');

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage($logo);

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite($twitter);
        TwitterCard::setImage($logo);
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl($url);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateVideosTagMeta($tag)
    {
        $locale = app()->getLocale();

        $title = $tag . ' | ' . config('meta.app_name');

        $description = $locale === 'en'
            ? 'Explore the latest videos of photos and media. Enjoy and share your favorite videos.'
            : 'সর্বশেষ ফটো ও মিডিয়া ভিডিও দেখুন। আপনার প্রিয় ভিডিওগুলি উপভোগ করুন এবং শেয়ার করুন।';

        $url = url()->current();
        $logo = url(config('meta.logo'));
        $twitter = config('meta.twitter', '@lensasiabangla');

        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'website');
        OpenGraph::addImage($logo);

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setSite($twitter);
        TwitterCard::setImage($logo);
        TwitterCard::setType('summary_large_image');

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setUrl($url);
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
    }
    public function generateVideoMeta($item)
    {
        $video = $item->url ? $item->url : url(paths()['video_main'] . $item->video);
        $locale = app()->getLocale();
        $description = Str::limit(strip_tags($item->description), 160);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($item?->keywords ?? '');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setSiteName(config('meta.app_name'));
        OpenGraph::setTitle($item?->title . ' | ' . config('meta.app_name'));
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'video');
        OpenGraph::addVideo($video, ['type' => 'video/mp4', 'width' => 1280, 'height' => 720]);

        TwitterCard::setTitle($item?->title . ' | ' . config('meta.app_name'));
        TwitterCard::setDescription($description);
        TwitterCard::setSite(config('meta.twitter', '@lensasiabangla'));
        TwitterCard::setUrl(url()->current());
        TwitterCard::setType('player');

        JsonLd::setType('VideoObject');
        JsonLd::setTitle($item?->title . ' | ' . config('meta.app_name'));
        JsonLd::setDescription($description);
        JsonLd::setUrl(url()->current());
        JsonLd::addValue('inLanguage', $locale . '-' . ($locale === 'en' ? 'US' : 'BD'));
        JsonLd::addValue('isAccessibleForFree', true);
        JsonLd::addValue('thumbnailUrl', $item->thumb ? url($item->thumb) : $item->thumb_url);
        JsonLd::addValue('uploadDate', $item->created_at?->toIso8601String());
        JsonLd::addValue('duration', 'PT2M30S');
        JsonLd::addValue('contentUrl', $video);
    }
}
