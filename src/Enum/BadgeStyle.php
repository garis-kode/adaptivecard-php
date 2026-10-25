<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum BadgeStyle: string
{
    case Default = 'Default';
    case Subtle = 'Subtle';
    case Informative = 'Informative';
    case Accent = 'Accent';
    case Good = 'Good';
    case Attention = 'Attention';
    case Warning = 'Warning';
}
