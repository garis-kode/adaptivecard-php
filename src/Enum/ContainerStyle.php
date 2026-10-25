<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ContainerStyle: string
{
    case Default = 'default';
    case Emphasis = 'emphasis';
    case Good = 'good';
    case Attention = 'attention';
    case Warning = 'warning';
    case Accent = 'accent';
}
