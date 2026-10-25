<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TextInputStyle: string
{
    case Text = 'Text';
    case Tel = 'Tel';
    case Url = 'Url';
    case Email = 'Email';
    case Password = 'Password';
}
