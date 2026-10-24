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
     * Label for this input.
     */
    public function label(string $label): static
    {
        return $this->set('label', $label);
    }

    /**
     * Whether or not this input is required.
     */
    public function isRequired(bool $required = true): static
    {
        return $this->set('isRequired', $required);
    }

    /**
     * Error message to display when entered input is invalid.
     */
    public function errorMessage(string $message): static
    {
        return $this->set('errorMessage', $message);
    }

    /**
     * Specifies the position of the label relative to the input control.
     * Valid values: "Above", "Before", "Inline".
     */
    public function labelPosition(string|InputLabelPosition $position): static
    {
        return $this->set('labelPosition', InputLabelPosition::value($position));
    }

    /**
     * Controls the width of the label when labelPosition is set to Before.
     * Supports pixel values, percentage values, or "auto".
     */
    public function labelWidth(string|int $width): static
    {
        return $this->set('labelWidth', $width);
    }

    /**
     * The initial value for this field.
     */
    public function value(string|int|float|bool $value): static
    {
        return $this->set('value', $value);
    }

    /**
     * Controls whether the label is visible.
     */
    public function showLabel(bool $show = true): static
    {
        return $this->set('showLabel', $show);
    }

    /**
     * An Action that is invoked when the user changes the value of this input.
     */
    public function valueChangedAction(AbstractAction $action): static
    {
        return $this->set('valueChangedAction', $action);
    }
}
