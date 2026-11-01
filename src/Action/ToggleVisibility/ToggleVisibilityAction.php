<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\ToggleVisibility;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Support\HasMenuActions;

/**
 * Toggles the visibility of a set of elements. `Action.ToggleVisibility` is useful for creating
 * "Show more" type UI patterns.
 */
final class ToggleVisibilityAction extends AbstractAction
{
    use HasMenuActions;

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
        return $this->addTargetElements(new TargetElement($elementId, $isVisible));
    }

    /**
     * Add a target element.
     *
     * @param TargetElement|iterable<TargetElement> $target
     */
    public function addTargetElements(TargetElement|iterable $target): self
    {
        if (is_iterable($target)) {
            foreach ($target as $item) {
                $this->push('targetElements', $item);
            }

            return $this;
        }

        return $this->push('targetElements', $target);
    }

    /**
     * The Ids of the elements to toggle the visibility of.
     * Valid values: "TargetElement".
     *
     * @param iterable<TargetElement> $targets
     */
    public function targetElements(iterable $targets): self
    {
        return $this->addTargetElements($targets);
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
