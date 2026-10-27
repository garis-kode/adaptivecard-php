<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ProgressBarColor: string
{
    case Accent = 'Accent';
    case Good = 'Good';
    case Warning = 'Warning';
    case Attention = 'Attention';
}
