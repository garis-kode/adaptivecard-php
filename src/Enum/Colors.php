<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum Colors: string
{
    use EnumValue;

    case Default = 'default';
    case Dark = 'dark';
    case Light = 'light';
    case Accent = 'accent';
    case Good = 'good';
    case Warning = 'warning';
    case Attention = 'attention';
}
