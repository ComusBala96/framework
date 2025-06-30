<?php

namespace Orian\Framework\Traits\Migrations;

use App\Models\Message;
use Webpatser\Uuid\Uuid;
use App\Models\Old\OldMessage;

trait UpdateMessages
{
    public function UpdateMessages()
    {
        Message::truncate();
        $messages = [];
        foreach (OldMessage::get() as $key => $item) {
            // if (in_array($item->id, [12, 107])) {
            //     continue;
            // }
            if (!isValidUtf8($item->message)) {
                continue;
            }
            if (preg_match('/[\p{Cyrillic}]/u', $item->message)) {
                continue;
            }

            $messages[] = [
                'uuid' => (string) Uuid::generate(4),
                'serial' => $key + 1,
                'name' => $item->name,
                'email' => $item->email,
                'phone' => $item->phone,
                'subject' => substr($item->message, 0, 100),
                'message' => $item->message,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if (count($messages) >= 300) {
                Message::insert($messages);
                $messages = [];
            }
        }
        if (!empty($messages)) {
            Message::insert($messages);
        }
    }
}
