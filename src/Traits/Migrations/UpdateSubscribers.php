<?php

namespace Orian\Framework\Traits\Migrations;

use Webpatser\Uuid\Uuid;
use App\Models\Subscriber;
use App\Models\Old\OldSubscriber;

trait UpdateSubscribers
{
    public function UpdateSubscribers()
    {
        Subscriber::truncate();
        $subscribers = [];
        foreach (OldSubscriber::get() as $key => $item) {
            $subscribers[] = ['uuid' => (string) Uuid::generate(4), 'serial' => $key + 1, 'name' => explode('@', $item->email)[0], 'email' => $item->email, 'created_at' => now(), 'updated_at' => now(), ];
            if (count($subscribers) >= 300) {
                Subscriber::insert($subscribers);
                $subscribers = [];
            }
        }
        if (!empty($subscribers)) {
            Subscriber::insert($subscribers);
        }
    }
}
