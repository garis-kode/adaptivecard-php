<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum Colors: string
{
    case Default = 'Default';
    case Dark = 'Dark';
    case Light = 'Light';
    case Accent = 'Accent';
    case Good = 'Good';
    case Warning = 'Warning';
    case Attention = 'Attention';
}
