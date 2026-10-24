<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * Lets the user enter a number.
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

    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    public function min(int|float $min): self
    {
        return $this->set('min', $min);
    }

    public function max(int|float $max): self
    {
        return $this->set('max', $max);
    }

    public function getType(): string
    {
        return 'Input.Number';
    }
}
