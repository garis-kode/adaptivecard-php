<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ActionMode: string
{
    use EnumValue;

    case Primary = 'primary';
    case Secondary = 'secondary';
}
