<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum AssociatedInputs: string
{
    use EnumValue;

    case Auto = 'Auto';
    case None = 'None';
}
