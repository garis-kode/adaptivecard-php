<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageFillMode: string
{
    case Cover = 'cover';
    case RepeatHorizontally = 'repeatHorizontally';
    case RepeatVertically = 'repeatVertically';
    case Repeat = 'repeat';
}
