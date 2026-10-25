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
     * Description of the input desired. Displayed when no input has been made.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * Minimum value.
     */
    public function min(int|float $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * Maximum value.
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
