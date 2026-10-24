<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TextBlockStyle: string
{
    use EnumValue;

    case Default = 'default';
    case Heading = 'heading';
    case ColumnHeader = 'columnHeader';
}
