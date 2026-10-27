<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum PageAnimation: string
{
    case Slide = 'Slide';
    case CrossFade = 'CrossFade';
    case None = 'None';
}
