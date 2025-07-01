<?php

namespace Orian\Framework\Traits\Migrations;

use App\Models\Role;
use App\Models\User;
use Webpatser\Uuid\Uuid;
use App\Models\Old\OldUser;
use Illuminate\Support\Facades\File;
use Orian\Framework\Helper\Helper;

trait UpdateUsers
{
    public function updateUsers()
    {
        $roleMap = Role::pluck('id', 'name')->mapWithKeys(fn ($id, $name) => [strtolower($name) => $id])->toArray();
        $path = paths()['user'];
        Helper::createDir($path);
        File::cleanDirectory($path);
        $now = now();
        $users = [];
        $assignments = [];
        foreach (OldUser::all() as $key => $item) {
            if (!empty($item->username) && $item->email != 'comusbala96@gmail.com') {
                $profile = null;
                if (!empty($item->avatar)) {
                    $oldPath = public_path(oldPaths()['news'] . $item->avatar);
                    if (file_exists($oldPath)) {
                        $ext = pathinfo($oldPath, PATHINFO_EXTENSION);
                        $name = (string) Uuid::generate(4);
                        Helper::createImages($oldPath, [['width' => 240, 'height' => 240]], $path, $name, $ext, 100, 'noVariant');
                        $profile = $name . '.' . $ext;
                    }
                }
                $roleKey = strtolower($item->role);
                $roleId = $roleMap[$roleKey] ?? null;

                if ($roleId) {
                    $uuid = (string) (string) Uuid::generate(4);
                    $users[] = ['uuid' => $uuid, 'serial' => ($key + 1), 'name' => $item->username, 'email' => $item->email, 'password' => $item->password, 'profile' => $profile, 'about' => $item->about_me, 'facebook' => $item->facebook, 'twitter' => $item->twitter, 'instagram' => $item->instagram, 'linkedin' => $item->linkedin, 'telegram' => $item->telegram, 'youtube' => $item->youtube, 'tiktok' => $item->tiktok, 'website' => $item->website, 'role_id' => $roleId, 'role' => $item->role, 'status' => 'active', 'created_at' => $item->created_at, 'updated_at' => $now, ];
                    $assignments[] = [
                        'uuid' => $uuid,
                        'role' => ucfirst($roleKey),
                    ];
                }
            }
        }
        User::insert($users);
        foreach ($assignments as $assign) {
            if ($user = User::where('uuid', $assign['uuid'])->first()) {
                $user->assignRole($assign['role']);
            }
        }
    }
}
