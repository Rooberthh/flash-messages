<?php

namespace Rooberthh\FlashMessage\Domain\Support\Enums;

enum Status: string
{
    case SUCCESS = 'success';
    case DANGER = 'danger';
    case WARNING = 'warning';
    case INFO = 'info';
}
