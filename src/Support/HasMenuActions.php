<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Action\AbstractAction;

trait HasMenuActions
{
    /**
     * Add actions to display in the overflow menu of a Split action button.
     *
     * @param AbstractAction|iterable<AbstractAction> $action
     */
    public function addMenuActions(AbstractAction|iterable $action): static
    {
        if (is_iterable($action)) {
            foreach ($action as $item) {
                $this->push('menuActions', $item);
            }

            return $this;
        }

        return $this->push('menuActions', $action);
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
