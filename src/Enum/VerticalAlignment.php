<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

/**
 * Used for both `verticalAlignment` and `verticalContentAlignment` properties.
 */
enum VerticalAlignment: string
{
    case Top = 'Top';
    case Center = 'Center';
    case Bottom = 'Bottom';
}
