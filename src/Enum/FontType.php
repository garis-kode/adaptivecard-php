<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum FontType: string
{
    use EnumValue;

    case Default = 'default';
    case Monospace = 'monospace';
}
