<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ProgressRingSize: string
{
    use EnumValue;

    case Tiny = 'Tiny';
    case Small = 'Small';
    case Medium = 'Medium';
    case Large = 'Large';
}
