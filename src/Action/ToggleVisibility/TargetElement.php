<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\ToggleVisibility;

use AdaptiveCards\Node;

/**
 * Defines a target element in an Action.ToggleVisibility.
 */
final class TargetElement extends Node
{
    public function __construct(string $elementId, ?bool $isVisible = null)
    {
        $this->elementId($elementId);
       
        if ($isVisible !== null) {
            $this->isVisible($isVisible);
        }
    }

    public static function make(string $elementId, ?bool $isVisible = null): self
    {
        return new self($elementId, $isVisible);
    }

    /**
     * Element ID of the element to toggle.
     */
    public function elementId(string $elementId): self
    {
        return $this->set('elementId', $elementId);
    }

    /**
     * If null, toggle current visibility of element. If true, show element. If false, hide element.
     */
    public function isVisible(bool $isVisible = true): self
    {
        return $this->set('isVisible', $isVisible);
    }

    public function getType(): ?string
    {
        return null;
    }
}
