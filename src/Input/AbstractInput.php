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
        $this->set('id', $id);
    }

    public function label(string $label): static
    {
        return $this->set('label', $label);
    }

    public function isRequired(bool $required = true): static
    {
        return $this->set('isRequired', $required);
    }

    public function errorMessage(string $message): static
    {
        return $this->set('errorMessage', $message);
    }

    public function labelPosition(string|InputLabelPosition $position): static
    {
        return $this->set('labelPosition', InputLabelPosition::value($position));
    }

    public function labelWidth(string|int $width): static
    {
        return $this->set('labelWidth', $width);
    }

    public function value(string|int|float|bool $value): static
    {
        return $this->set('value', $value);
    }

    public function showLabel(bool $show = true): static
    {
        return $this->set('showLabel', $show);
    }

    public function valueChangedAction(AbstractAction $action): static
    {
        return $this->set('valueChangedAction', $action);
    }
}
