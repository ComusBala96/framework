<?php

namespace Orian\Framework\Traits;

use Orian\Framework\Traits\Dependency;
use Orian\Framework\Traits\SeoTool\SeoTool;
use Orian\Framework\Traits\DomDocument\MakeDocument;

trait BaseTrait
{
    //Dependency
    use Dependency , MakeDocument, SeoTool;
}
