<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

/**
 * BlockElementHeight — controls how an element uses available vertical space.
 */
enum Height: string
{
    use EnumValue;

    case Auto = 'auto';
    case Stretch = 'stretch';
}
