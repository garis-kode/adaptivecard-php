<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum InputLabelPosition: string
{
    use EnumValue;

    case Inline = 'inline';
    case Above = 'above';
}
