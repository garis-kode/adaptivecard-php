<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum PersonaIconStyle: string
{
    case ProfilePicture = 'profilePicture';
    case ContactCard = 'contactCard';
    case None = 'none';
}
