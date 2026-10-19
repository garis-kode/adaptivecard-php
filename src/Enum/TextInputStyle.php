<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum TextInputStyle: string
{
    use EnumValue;

    case Text = 'text';
    case Tel = 'tel';
    case Url = 'url';
    case Email = 'email';
    case Password = 'password';
}
