<?php

namespace Orian\Framework\Constant;

use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\File;

class Constant
{
    public static function defaultImageAccepts()
    {
        return[
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/webp',
        ];
    }

    public static function defaultVideoAccepts()
    {
        return[
            'video/mp4',
        ];
    }

    public static function defaultProfileSize()
    {
        return[
            ['width' => 180, 'height' => 180]
        ];
    }

    public static function defaultCoverSize()
    {
        return[
            ['width' => 1024, 'height' => 360]
        ];
    }

    public static function defaultPostImageSize()
    {
        return[
            ['width' => 630, 'height' => 240],
            ['width' => 1024, 'height' => 390],
            ['width' => 1920, 'height' => 730]
        ];
    }

    public static function defaultAdImageSize()
    {
        return[
            ['width' => 630, 'height' => 120],
            ['width' => 768, 'height' => 146],
            ['width' => 1260, 'height' => 240]
        ];
    }

    public static function defaultFileFormat()
    {
        return [
            'pdf',
            'doc',
            'docx',
        ];
    }

    public static function defaultFileAccepts()
    {
        return[
            'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword'
        ];
    }

    public static function defaultDtSize()
    {
        return [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 100, 500, 1000, 1500, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 100000, 200000, 300000];
    }

    public static function defaultRoles()
    {
        $now = now();
        return[
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'name' => 'Admin', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'name' => 'Moderator', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'name' => 'Author', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'name' => 'User', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
        ];
    }

    public static function defaultPermissions()
    {
        $now = now();
        return[
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'name' => 'Navigation', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'name' => 'Menus', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'name' => 'Categories', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'name' => 'Pages', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'name' => 'Tags', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 6, 'name' => 'Keywords', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 7, 'name' => 'Roles & Permissions', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 8, 'name' => 'Roles', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 9, 'name' => 'Permissions', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 10, 'name' => 'Assign Access', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 11, 'name' => 'Manage Users', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 12, 'name' => 'Create & Manage Users', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 13, 'name' => 'Administrators', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 14, 'name' => 'Users', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 15, 'name' => 'Subscribers', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 16, 'name' => 'Add Post', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 17, 'name' => 'Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 18, 'name' => 'Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 19, 'name' => 'Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 20, 'name' => 'View Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 21, 'name' => 'Article Posts', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 22, 'name' => 'Breaking Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 23, 'name' => 'Headline Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 24, 'name' => 'Latest Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 25, 'name' => 'Feature Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 26, 'name' => 'Popular Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 27, 'name' => 'Approved Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 28, 'name' => 'Private Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 29, 'name' => 'Pending Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 30, 'name' => 'Scheduled Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 31, 'name' => 'Draft Article', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 32, 'name' => 'View Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 33, 'name' => 'Gallery Posts', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 34, 'name' => 'Approved Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 35, 'name' => 'Private Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 36, 'name' => 'Pending Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 37, 'name' => 'Scheduled Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 38, 'name' => 'Draft Gallery', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 39, 'name' => 'View Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 40, 'name' => 'Video Posts', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 41, 'name' => 'Approved Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 42, 'name' => 'Private Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 43, 'name' => 'Pending Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 44, 'name' => 'Scheduled Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 45, 'name' => 'Draft Video', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 46, 'name' => 'Poll', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 47, 'name' => 'Vote', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 48, 'name' => 'Ad Spaces', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 49, 'name' => 'Breaking Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 50, 'name' => 'Latest Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 51, 'name' => 'Trending Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 52, 'name' => 'News Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 53, 'name' => 'Ad Positions', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 54, 'name' => 'Header Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 55, 'name' => 'Middle Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 56, 'name' => 'Footer Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 57, 'name' => 'Side Ad', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 58, 'name' => 'Google AdSense', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 59, 'name' => 'Manage Comments', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 60, 'name' => 'Comments', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 61, 'name' => 'Comment Replays', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 62, 'name' => 'Contact Messages', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 63, 'name' => 'Add Messages', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 64, 'name' => 'Messages', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 65, 'name' => 'Message Replays', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 66, 'name' => 'Mailbox', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 67, 'name' => 'Add Mail', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 68, 'name' => 'Compose', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 69, 'name' => 'Mailbox Users', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 70, 'name' => 'Mailbox Administrators', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 71, 'name' => 'Mailbox Subscribers', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 72, 'name' => 'Mailbox Sent', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 73, 'name' => 'Mailbox Draft', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 74, 'name' => 'SEO Tools', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 75, 'name' => 'Page SEO', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 76, 'name' => 'SEO Activities', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 77, 'name' => 'Google Analytics', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 78, 'name' => 'Color Management', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 79, 'name' => 'Font Management', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 80, 'name' => 'Configurations', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 81, 'name' => 'General Settings', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 82, 'name' => 'Preferences', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 83, 'name' => 'Limitations', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 84, 'name' => 'Database Backup', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 85, 'name' => 'Assets Backup', 'guard_name' => 'web', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
        ];
    }

    public static function defaultPage()
    {
        $now = now();
        return [
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'en', 'title' => 'Terms & Conditions', 'description' => 'Please Update Description', 'visibility' => 1, 'content' => 'Please Update Content', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'bn', 'title' => 'শর্তাবলি ও নিয়মাবলি', 'description' => 'অনুগ্রহ করে বর্ণনা হালনাগাদ করুন', 'visibility' => 1, 'content' => 'Please Update Content', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ]
        ];
    }

    public static function themeLightEnColors()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'lang' => 'en', 'mode' => 'light', 'created_by' => 1, 'topbar' => '#06467F', 'navbar' => '#F7F9FB', 'navbar_hover' => '#2EDCDC', 'active_border' => '#faba1c', 'breaking' => '#dc2626', 'breaking_bg' => '#06467F', 'body' => '#FFFFFF', 'background' => '#CDDAE6', 'subscriber' => '#06467F', 'footer' => '#010101', 'copyright' => '#F7F9FB', 'scroller' => '#dc2626', 'scroller_hover' => '#b91c1c', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function themeLightBnColors()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'lang' => 'bn', 'mode' => 'light', 'created_by' => 1, 'topbar' => '#06467F', 'navbar' => '#F7F9FB', 'navbar_hover' => '#2EDCDC', 'active_border' => '#faba1c', 'breaking' => '#dc2626', 'breaking_bg' => '#06467F', 'body' => '#FFFFFF', 'background' => '#CDDAE6', 'subscriber' => '#06467F', 'footer' => '#010101', 'copyright' => '#F7F9FB', 'scroller' => '#dc2626', 'scroller_hover' => '#b91c1c', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function themeDarkEnColors()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'lang' => 'en', 'mode' => 'dark', 'created_by' => 1, 'topbar' => '#24303F', 'navbar' => '#24303F', 'navbar_hover' => '#2EDCDC', 'active_border' => '#faba1c', 'breaking' => '#dc2626', 'breaking_bg' => '#06467F', 'body' => '#24303F', 'background' => '#1F334C', 'subscriber' => '#06467F', 'footer' => '#010101', 'copyright' => '#06467F', 'scroller' => '#dc2626', 'scroller_hover' => '#b91c1c', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function themeDarkBnColors()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'lang' => 'bn', 'mode' => 'dark', 'created_by' => 1, 'topbar' => '#24303F', 'navbar' => '#24303F', 'navbar_hover' => '#2EDCDC', 'active_border' => '#faba1c', 'breaking' => '#dc2626', 'breaking_bg' => '#06467F', 'body' => '#24303F', 'background' => '#1F334C', 'subscriber' => '#06467F', 'footer' => '#010101', 'copyright' => '#06467F', 'scroller' => '#dc2626', 'scroller_hover' => '#b91c1c', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function defaultFonts()
    {
        $now = now();
        return [
            // en fonts
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'en', 'name' => 'Arial', 'family' => 'font-family: Arial, Helvetica, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'en', 'name' => 'Helvetica', 'family' => 'font-family:Helvetica, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'lang' => 'en', 'name' => 'Courier New', 'family' => 'font-family:"Courier New", Courier, monospace', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'lang' => 'en', 'name' => 'Franklin Gothic Medium', 'family' => 'font-family:"Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'lang' => 'en', 'name' => 'Gill Sans', 'family' => 'font-family:"Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 6, 'lang' => 'en', 'name' => 'Lucida Sans', 'family' => 'font-family:"Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 7, 'lang' => 'en', 'name' => 'Segoe UI', 'family' => 'font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 8, 'lang' => 'en', 'name' => 'Times New Roman', 'family' => 'font-family:"Times New Roman", Times, serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 9, 'lang' => 'en', 'name' => 'Trebuchet MS', 'family' => 'font-family:"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 10, 'lang' => 'en', 'name' => 'Cambria', 'family' => 'font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 11, 'lang' => 'en', 'name' => 'Georgia', 'family' => 'font-family: Georgia, "Times New Roman", Times, serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 12, 'lang' => 'en', 'name' => 'Impact', 'family' => 'font-family:Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 13, 'lang' => 'en', 'name' => 'fantasy', 'family' => 'font-family:fantasy', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 14, 'lang' => 'en', 'name' => 'inherit', 'family' => 'font-family:inherit', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 15, 'lang' => 'en', 'name' => 'initial', 'family' => 'font-family:initial', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 16, 'lang' => 'en', 'name' => 'monospace', 'family' => 'font-family:monospace', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 17, 'lang' => 'en', 'name' => 'sans-serif', 'family' => 'font-family:sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 18, 'lang' => 'en', 'name' => 'serif', 'family' => 'font-family:serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 19, 'lang' => 'en', 'name' => 'unset', 'family' => 'font-family:unset', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            // bn fonts
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'bn', 'name' => 'Kalpurush', 'family' => 'font-family: Kalpurush, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'bn', 'name' => 'SolaimanLipi', 'family' => 'font-family: SolaimanLipi, sans-serif', 'url' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'lang' => 'bn', 'name' => 'Noto Sans Bengali', 'family' => 'font-family: "Noto Sans Bengali", sans-serif', 'url' => '<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'lang' => 'bn', 'name' => 'Tiro Bangla', 'family' => 'font-family: "Tiro Bangla", serif', 'url' => '<link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
        ];
    }

    public static function defaultMenus()
    {
        $now = now();
        return [
            // Menu en
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'en', 'type' => 'menu', 'title' => 'Home', 'visibility' => 1, 'homepage' => 0, 'homepage_serial' => null, 'block' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'en', 'type' => 'menu', 'title' => 'Politics', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 1, 'block' => 'Block-1', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'lang' => 'en', 'type' => 'menu', 'title' => 'Business', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 2, 'block' => 'Block-2', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'lang' => 'en', 'type' => 'menu', 'title' => 'Sports', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 3, 'block' => 'Block-3', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'lang' => 'en', 'type' => 'menu', 'title' => 'World', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 4, 'block' => 'Block-4', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 6, 'lang' => 'en', 'type' => 'menu', 'title' => 'Technology', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 5, 'block' => 'Block-5', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 7, 'lang' => 'en', 'type' => 'menu', 'title' => 'Opinion', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 6, 'block' => 'Block-6', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            // Menu bn
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'bn', 'type' => 'menu', 'title' => 'হোম', 'visibility' => 1, 'homepage' => 0, 'homepage_serial' => null, 'block' => null, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'bn', 'type' => 'menu', 'title' => 'রাজনীতি', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 1, 'block' => 'Block-1', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'lang' => 'bn', 'type' => 'menu', 'title' => 'ব্যবসা', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 2, 'block' => 'Block-2', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'lang' => 'bn', 'type' => 'menu', 'title' => 'খেলা', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 3, 'block' => 'Block-3', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'lang' => 'bn', 'type' => 'menu', 'title' => 'বিশ্ব', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 4, 'block' => 'Block-4', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 6, 'lang' => 'bn', 'type' => 'menu', 'title' => 'প্রযুক্তি', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 5, 'block' => 'Block-5', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 7, 'lang' => 'bn', 'type' => 'menu', 'title' => 'মতামত', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 6, 'block' => 'Block-6', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            // Category en
            ['uuid' => (string)Uuid::generate(4), 'serial' => 8, 'lang' => 'en', 'type' => 'category', 'title' => 'Multimedia', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 7, 'block' => 'Block-7', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 9, 'lang' => 'en', 'type' => 'category', 'title' => 'Health', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 8, 'block' => 'Block-1', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 10, 'lang' => 'en', 'type' => 'category', 'title' => 'Travel', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 9, 'block' => 'Block-2', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 11, 'lang' => 'en', 'type' => 'category', 'title' => 'Lifestyle', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 10, 'block' => 'Block-3', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            // Category bn
            ['uuid' => (string)Uuid::generate(4), 'serial' => 8, 'lang' => 'bn', 'type' => 'category', 'title' => 'মাল্টিমিডিয়া', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 7, 'block' => 'Block-7', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 9, 'lang' => 'bn', 'type' => 'category', 'title' => 'স্বাস্থ্য', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 8, 'block' => 'Block-1', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 10, 'lang' => 'bn', 'type' => 'category', 'title' => 'ভ্রমণ', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 9, 'block' => 'Block-2', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 11, 'lang' => 'bn', 'type' => 'category', 'title' => 'জীবনধারা', 'visibility' => 1, 'homepage' => 1, 'homepage_serial' => 10, 'block' => 'Block-3', 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
        ];
    }

    public static function defaultConfigurations()
    {
        $now = now();
        return [
            'uuid' => (string)Uuid::generate(4),
            'mail_mailer' => config('config.mail_mailer', env('MAIL_MAILER', 'smtp')),
            'mail_host' => config('config.mail_host', env('MAIL_HOST', 'lensasia.net')),
            'mail_port' => config('config.mail_port', env('MAIL_PORT', '465')),
            'mail_username' => config('config.mail_username', env('MAIL_USERNAME', 'info@lensasia.net')),
            'mail_password' => config('config.mail_password', env('MAIL_PASSWORD', 'info@lensasia.net')),
            'mail_encryption' => config('config.mail_encryption', env('MAIL_ENCRYPTION', 'ssl')),
            'mail_from_address' => config('config.mail_from_address', env('MAIL_FROM_ADDRESS', 'info@lensasia.net')),
            'mail_from_name' => config('config.mail_from_name', env('MAIL_FROM_NAME', 'Lens Asia')),
            'google_id' => config('config.google_id', env('GOOGLE_CLIENT_ID', '487644642')),
            'google_secret' => config('config.google_secret', env('GOOGLE_CLIENT_SECRET', '487644642')),
            'analytics_id' => config('config.analytics_id', env('ANALYTICS_PROPERTY_ID', '487644642')),
            'dt_size' => config('config.dt_size', env('APP_DEFAULT_DT_SIZE', '15')),
            'profile_image_format' => 'jpg', 'profile_image_accepts' => json_encode(defaultImageAccepts()),
            'profile_image_size' => json_encode(defaultProfileSize()),
            'cover_image_format' => 'jpg',
            'cover_image_accepts' => json_encode(defaultImageAccepts()),
            'cover_image_size' => json_encode(defaultCoverSize()),
            'post_image_format' => 'jpg', 'post_image_accepts' => json_encode(defaultImageAccepts()),
            'post_image_size' => json_encode(defaultPostImageSize()),
            'ad_image_format' => 'jpg', 'ad_image_accepts' => json_encode(defaultImageAccepts()),
            'ad_image_size' => json_encode(defaultAdImageSize()),
            'video_format' => 'mp4',
            'video_accepts' => json_encode(defaultVideoAccepts()),
            'file_format' => json_encode(defaultFileFormat()),
            'file_accepts' => json_encode(defaultFileAccepts()),
            'created_by' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    public static function defaultLimits()
    {
        $now = now();
        return [
            ['uuid' => (string)Uuid::generate(4), 'lang' => 'en', 'd_users' => 4, 'd_message' => 7, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'lang' => 'bn', 'd_users' => 4, 'd_message' => 7, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ]
        ];
    }

    public static function defaultPostLimits()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'article_title_min' => 35, 'article_title_max' => 253, 'article_description_min' => 35, 'article_description_max' => 2000, 'article_keywords_min' => 0, 'article_keywords_max' => 20, 'article_tags_min' => 0, 'article_tags_max' => 20, 'article_url_min' => 0, 'article_url_max' => 253,  'article_image_url_min' => 0, 'article_image_url_max' => 253, 'article_image_caption_min' => 0, 'article_image_caption_max' => 253, 'article_additional_images_min' => 0, 'article_additional_images_max' => 10, 'article_files_min' => 0, 'article_files_max' => 5, 'gallery_title_min' => 35, 'gallery_title_max' => 253, 'gallery_description_min' => 35, 'gallery_description_max' => 2000, 'gallery_keywords_min' => 0, 'gallery_keywords_max' => 20, 'gallery_tags_min' => 0, 'gallery_tags_max' => 20, 'gallery_url_min' => 0, 'gallery_url_max' => 253, 'gallery_image_url_min' => 0, 'gallery_image_url_max' => 253, 'gallery_image_caption_min' => 0, 'gallery_image_caption_max' => 253, 'gallery_additional_images_min' => 0, 'gallery_additional_images_max' => 10, 'gallery_files_min' => 0, 'gallery_files_max' => 5, 'video_title_min' => 35, 'video_title_max' => 253, 'video_description_min' => 35, 'video_description_max' => 2000, 'video_keywords_min' => 0, 'video_keywords_max' => 20, 'video_tags_min' => 0, 'video_tags_max' => 20, 'video_url_min' => 0, 'video_url_max' => 253, 'video_image_url_min' => 0, 'video_image_url_max' => 253, 'video_image_caption_min' => 0, 'video_image_caption_max' => 253, 'video_additional_images_min' => 0, 'video_additional_images_max' => 10, 'video_files_min' => 0, 'video_files_max' => 5, 'poll_question_min' => 35, 'poll_question_max' => 500, 'poll_option_min' => 0, 'poll_option_max' => 253, 'vote_question_min' => 35, 'vote_question_max' => 500, 'vote_option_min' => 0, 'vote_option_max' => 253, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function defaultPreferences()
    {
        $now = now();
        return ['uuid' => (string)Uuid::generate(4), 'two_factor' => true, 'verify' => true, 'email' => true, 'attachment' => true, 'breaking' => true, 'hero' => true, 'trending' => true, 'popular' => true, 'latest' => true, 'video' => true, 'gallery' => true, 'subscriber' => true, 'footer_category' => true, 'breaking_ad' => true, 'latest_ad' => true, 'trending_ad' => true, 'header_ad' => true, 'middle_ad' => true, 'side_ad' => true, 'footer_ad' => true, 'news_ad' => true, 'comments' => true, 'comments_form' => true, 'post_date' => true, 'social_link' => true, 'print_option' => true, 'author' => true, 'article_module' => true, 'gallery_module' => true, 'video_module' => true, 'poll_module' => true, 'vote_module' => true, 'profile' => true, 'cover' => true, 'profile_date' => true, 'profile_email' => true, 'profile_news' => true, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
    }

    public static function defaultBlocks()
    {
        $path = paths()['block'];
        createDir($path);
        File::cleanDirectory($path);
        $files = File::files(public_path('statics/block/images/'));
        $now = now();
        $blocks = [];
        foreach ($files as $key => $file) {
            $name = (string)Uuid::generate(4);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            createImages($file, [['width' => 360, 'height' => 180]], $path, $name, $ext, 1, 'noVariant');
            $blocks[] = ['uuid' => (string)Uuid::generate(4), 'serial' => $key + 1, 'name' => 'Block-' . ($key + 1), 'image' => $name . '.' . $ext, 'created_by' => 1, 'created_at' => $now, 'updated_at' => $now, ];
        }
        return $blocks;
    }

    public static function defaultNewsAd()
    {
        $now = now();
        return [
            ['uuid' => (string)Uuid::generate(4), 'serial' => 1, 'lang' => 'en', 'type' => 'news', 'position' => 1, 'name' => 'Header Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 2, 'lang' => 'en', 'type' => 'news', 'position' => 2, 'name' => 'First Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 3, 'lang' => 'en', 'type' => 'news', 'position' => 3, 'name' => 'Second Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 4, 'lang' => 'en', 'type' => 'news', 'position' => 4, 'name' => 'Footer Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],

            ['uuid' => (string)Uuid::generate(4), 'serial' => 5, 'lang' => 'bn', 'type' => 'news', 'position' => 1, 'name' => 'Header Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 6, 'lang' => 'bn', 'type' => 'news', 'position' => 2, 'name' => 'First Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 7, 'lang' => 'bn', 'type' => 'news', 'position' => 3, 'name' => 'Second Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
            ['uuid' => (string)Uuid::generate(4), 'serial' => 8, 'lang' => 'bn', 'type' => 'news', 'position' => 4, 'name' => 'Footer Para Advertisement', 'image' => null, 'size_sm' => null, 'size_md' => null, 'size_xl' => null, 'ext' => null, 'image_url' => null, 'link' => null, 'visibility' => 0, 'sponsored' => 0, 'created_by' => 1, 'updated_by' => null, 'created_at' => $now, 'updated_at' => $now, ],
        ];
    }
}
