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
     * Add multiple actions to the set.
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

    /**
     * The actions in the set.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.ShowCard", "Action.Submit",
     * "Action.ToggleVisibility".
     *
     * @param iterable<AbstractAction> $actions
     */
    public function actions(iterable $actions): self
    {
        return $this->addActions($actions);
    }

    public function getType(): string
    {
        return 'ActionSet';
    }
}
