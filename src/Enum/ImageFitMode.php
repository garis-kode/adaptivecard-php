<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ImageFitMode: string
{
    case Cover = 'Cover';
    case Contain = 'Contain';
    case Fill = 'Fill';
}
