<?php

namespace Orian\Framework\Traits;

use Orian\Framework\Traits\Dependency\ErrorDependency;
use Orian\Framework\Traits\Dependency\AutoloadDependency;
use Orian\Framework\Traits\Dependency\EloquentDependency;
use Orian\Framework\Traits\Dependency\ResponseDependency;
use Orian\Framework\Traits\Dependency\CheckExistsDependency;

trait Dependency
{
    //Dependency
    use AutoloadDependency, ErrorDependency, ResponseDependency, CheckExistsDependency, EloquentDependency;
}
