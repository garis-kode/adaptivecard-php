<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum IconSize: string
{
    use EnumValue;

    case XxSmall = 'xxSmall';
    case XSmall = 'xSmall';
    case Small = 'Small';
    case Standard = 'Standard';
    case Medium = 'Medium';
    case Large = 'Large';
    case XLarge = 'xLarge';
    case XxLarge = 'xxLarge';
}
