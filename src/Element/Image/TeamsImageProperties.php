<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a set of Teams-specific properties on an image.
 */
final class TeamsImageProperties extends Node
{
    use HasKey;

    public function __construct(?bool $allowExpand = null)
    {
        if ($allowExpand !== null) {
            $this->allowExpand($allowExpand);
        }
    }

    public static function make(?bool $allowExpand = null): self
    {
        return new self($allowExpand);
    }

    /**
     * Controls if the image is expandable in Teams. This property is equivalent to the
     * `Image.allowExpand` property.
     */
    public function allowExpand(bool $allow = true): self
    {
        return $this->set('allowExpand', $allow);
    }

    public function getType(): ?string
    {
        return null;
    }
}
