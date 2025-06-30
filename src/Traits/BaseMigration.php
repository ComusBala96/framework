<?php

namespace Orian\Framework\Traits;

use Orian\Framework\Traits\Migrations\UpdateFonts;
use Orian\Framework\Traits\Migrations\UpdatePosts;
use Orian\Framework\Traits\Migrations\UpdateUsers;
use Orian\Framework\Traits\Migrations\UpdateMessages;
use Orian\Framework\Traits\Migrations\UpdateSubscribers;

trait BaseMigration
{
    use UpdatePosts, UpdateUsers, UpdateFonts, UpdateMessages, UpdateSubscribers;
}
