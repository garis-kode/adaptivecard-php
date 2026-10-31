<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Enum\HorizontalAlignment;

trait HasHorizontalAlignment
{
    /**
     * Controls how the element should be horizontally aligned.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalAlignment(HorizontalAlignment $alignment): static
    {
        return $this->set('horizontalAlignment', $alignment->value);
    }
}
