<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\ToggleVisibility;

use AdaptiveCards\Action\AbstractAction;

/**
 * Toggles the visibility of a set of elements.
 */
final class ToggleVisibilityAction extends AbstractAction
{
    public function __construct(?string $title = null)
    {
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(?string $title = null): self
    {
        return new self($title);
    }

    /**
     * Toggle a target element by ID. Pass $isVisible to force a specific state;
     * omit it to flip the current state.
     */
    public function target(string $elementId, ?bool $isVisible = null): self
    {
        // The schema permits a bare id string when no explicit state is set.
        return $this->push(
            'targetElements',
            $isVisible === null ? $elementId : new TargetElement($elementId, $isVisible)
        );
    }

    /**
     * Add a target element.
     */
    public function addTarget(TargetElement $target): self
    {
        return $this->push('targetElements', $target);
    }

    /**
     * The array of elements to toggle the visibility of.
     *
     * @param iterable<string|TargetElement> $targets
     */
    public function targetElements(iterable $targets): self
    {
        foreach ($targets as $target) {
            if ($target instanceof TargetElement) {
                $this->addTarget($target);
            } else {
                $this->target($target);
            }
        }

        return $this;
    }

    /**
     * Controls whether the aria-controls attribute should be suppressed.
     */
    public function suppressAriaControls(bool $suppress = true): self
    {
        return $this->set('suppressAriaControls', $suppress);
    }

    public function getType(): string
    {
        return 'Action.ToggleVisibility';
    }
}
