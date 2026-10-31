<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Enum\Height;

trait HasHeight
{
    /**
     * The height of the element. When set to `stretch`, the element will use
     * the remaining vertical space in its container.
     * Valid values: "auto", "stretch".
     */
    public function height(Height $height): static
    {
        return $this->set('height', $height->value);
    }
}
