<?php

namespace Rooberthh\FlashMessage\Domain\Support\Enums;

enum Driver: string
{
    case DATABASE = 'database';
    case REDIS = 'redis';
    case SESSION = 'session';
}
