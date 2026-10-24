<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\ToggleVisibility;

use AdaptiveCards\Node;

/**
 * Names an element whose visibility a {@see ToggleVisibilityAction} affects,
 * optionally forcing it visible or hidden. Has no `type` field.
 *
 * When only an id is needed the schema also permits a bare string; see
 * {@see ToggleVisibilityAction::target()} which emits that compact form.
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

    public function elementId(string $elementId): self
    {
        return $this->set('elementId', $elementId);
    }

    public function isVisible(bool $isVisible = true): self
    {
        return $this->set('isVisible', $isVisible);
    }

    public function getType(): ?string
    {
        return null;
    }
}
