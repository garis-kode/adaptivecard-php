<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * An input to allow the user to enter a number.
 */
final class NumberInput extends AbstractInput
{
    public function __construct(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
    ) {
        parent::__construct($id);

        if ($label !== null) {
            $this->label($label);
        }
        if ($placeholder !== null) {
            $this->placeholder($placeholder);
        }
    }

    public static function make(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
    ): self {
        return new self($id, $label, $placeholder);
    }

    /**
     * The default value of the input.
     */
    public function value(int|float $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The text to display as a placeholder when the user hasn't entered a value.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * The minimum value that can be entered.
     */
    public function min(int|float $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The maximum value that can be entered.
     */
    public function max(int|float $max): self
    {
        return $this->set('max', $max);
    }

    public function getType(): string
    {
        return 'Input.Number';
    }
}
