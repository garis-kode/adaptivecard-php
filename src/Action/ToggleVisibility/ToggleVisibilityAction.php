<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\ToggleVisibility;

use AdaptiveCards\Action\AbstractAction;

/**
 * Shows, hides or toggles the visibility of one or more target elements.
 */
final class ToggleVisibilityAction extends AbstractAction
{
    public function __construct(?string $title = null)
    {
        $this->set('title', $title);
    }

    public static function make(?string $title = null): self
    {
        return new self($title);
    }

    /**
     * Toggle a target by id. Pass $isVisible to force a specific state;
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

    public function addTarget(TargetElement $target): self
    {
        return $this->push('targetElements', $target);
    }

    public function getType(): string
    {
        return 'Action.ToggleVisibility';
    }
}
