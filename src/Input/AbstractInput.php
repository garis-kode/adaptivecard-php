<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\InputLabelPosition;

/**
 * Shared base for all Input.* elements. Inputs extend the element base and add
 * id (required), label, error messaging and validation-related properties.
 */
abstract class AbstractInput extends AbstractElement
{
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
     * Controls whether the input is required. See **Input validation** for more details.
     */
    public function isRequired(bool $required = true): static
    {
        return $this->set('isRequired', $required);
    }

    /**
     * The error message to display when the input fails validation. See **Input validation**
     * for more details.
     */
    public function errorMessage(string $message): static
    {
        return $this->set('errorMessage', $message);
    }

    /**
     * Specifies the position of the label relative to the input control.
     * Valid values: "inline", "above", "before".
     */
    public function labelPosition(InputLabelPosition $position): static
    {
        return $this->set('labelPosition', $position->value);
    }

    /**
     * Controls the width of the label when labelPosition is set to Before.
     * Supports pixel values, percentage values, or "auto".
     */
    public function labelWidth(string $width): static
    {
        return $this->set('labelWidth', $width);
    }

    /**
     * The default value of the input.
     */
    public function value(string|int|float|bool $value): static
    {
        return $this->set('value', $value);
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
