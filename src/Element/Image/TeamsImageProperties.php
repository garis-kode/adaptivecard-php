<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Node;

/**
 * Teams-specific properties on an image. Has no `type` field.
 */
final class TeamsImageProperties extends Node
{
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

    public function allowExpand(bool $allow = true): self
    {
        return $this->set('allowExpand', $allow);
    }

    public function getType(): ?string
    {
        return null;
    }
}
