<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;

/**
 * Displays a set of action, which can be placed anywhere in the card.
 */
final class ActionSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add an action to the set.
     */
    public function addAction(AbstractAction $action): self
    {
        return $this->push('actions', $action);
    }

    /**
     * The list of actions to display.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function addActions(iterable $actions): self
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    public function getType(): string
    {
        return 'ActionSet';
    }
}
