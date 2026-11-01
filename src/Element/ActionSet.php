<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * Displays a set of action, which can be placed anywhere in the card.
 */
final class ActionSet extends AbstractBlockElement
{
    use HasHeight, HasHorizontalAlignment, HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add an action to the set.
     *
     * @param AbstractAction|iterable<AbstractAction> $action
     */
    public function addActions(AbstractAction|iterable $action): self
    {
        if (is_iterable($action)) {
            foreach ($action as $item) {
                $this->push('actions', $item);
            }

            return $this;
        }

        return $this->push('actions', $action);
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
