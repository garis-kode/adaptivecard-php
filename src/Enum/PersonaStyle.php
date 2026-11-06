<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum PersonaStyle: string
{
    case IconAndName = 'iconAndName';
    case IconOnly = 'iconOnly';
    case NameOnly = 'nameOnly';
}
