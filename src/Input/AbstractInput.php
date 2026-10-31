<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasSpacing;

abstract class AbstractInput extends AbstractBlockElement
{
    use HasHeight, HasSpacing;

    public function __construct(string $id)
    {
        $this->id($id);
    }

    /**
     * The label of the input. A label should always be provided to ensure the best
     * user experience especially for users of assistive technology.
     */
    public function label(string $label): static
    {
        return $this->set('label', $label);
    }

    /**
     * Controls whether the input is required.
     */
    public function isRequired(bool $required = true): static
    {
        return $this->set('isRequired', $required);
    }

    /**
     * The error message to display when the input fails validation.
     */
    public function errorMessage(string $message): static
    {
        return $this->set('errorMessage', $message);
    }

    /**
     * Controls whether the input's label is visually rendered. When set to false,
     * the label is still applied as the input's accessible name to ensure the best
     * user experience especially for users of assistive technology.
     */
    public function showLabel(bool $show = true): static
    {
        return $this->set('showLabel', $show);
    }

    /**
     * An `Action.ResetInputs` action that will be executed when the value of the input changes.
     * Valid values: "Action.OpenUrlDialog", "Action.Popover", "Action.ResetInputs", "Action.RunCommands".
     */
    public function valueChangedAction(AbstractAction $action): static
    {
        return $this->set('valueChangedAction', $action);
    }
}
