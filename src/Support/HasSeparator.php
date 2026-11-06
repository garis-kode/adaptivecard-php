<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

trait HasSeparator
{
    /**
     * Controls whether a separator line should be displayed above the element
     * to visually separate it from the previous element. No separator will be
     * displayed for the first element in a container, even if this property is
     * set to true.
     */
    public function separator(bool $separator = true): static
    {
        return $this->set('separator', $separator);
    }
}
