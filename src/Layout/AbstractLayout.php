<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Base class for responsive container layouts.
 */
abstract class AbstractLayout extends Node
{
    use HasKey;

    /**
     * Controls for which card width the layout should be used.
     * Valid values: "VeryNarrow", "Narrow", "Standard", "Wide",
     * "atLeast:VeryNarrow", "atMost:VeryNarrow", "atLeast:Narrow", "atMost:Narrow",
     * "atLeast:Standard", "atMost:Standard", "atLeast:Wide", "atMost:Wide".
     */
    public function targetWidth(TargetWidth $targetWidth): static
    {
        return $this->set('targetWidth', $targetWidth->value);
    }
}
