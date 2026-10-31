<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Action\AbstractAction;

trait HasMenuActions
{
    /**
     * Add an action to the flyout menu.
     */
    public function addMenuAction(AbstractAction $action): static
    {
        return $this->push('menuActions', $action);
    }

    /**
     * Add multiple actions to the flyout menu.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function addMenuActions(iterable $actions): static
    {
        foreach ($actions as $action) {
            $this->addMenuAction($action);
        }

        return $this;
    }

    /**
     * The actions to display in the overflow menu of a Split action button.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
     *
     * @param iterable<AbstractAction> $actions
     */
    public function menuActions(iterable $actions): static
    {
        return $this->addMenuActions($actions);
    }
}
