<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum MentionType: string
{
    case Person = 'Person';
    case Tag = 'Tag';
}
