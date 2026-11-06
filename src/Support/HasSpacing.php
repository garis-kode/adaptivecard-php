<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Enum\Spacing;

trait HasSpacing
{
    /**
     * Controls the amount of space between this element and the previous one.
     * No space will be added for the first element in a container.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function spacing(Spacing $spacing): static
    {
        return $this->set('spacing', $spacing->value);
    }
}
