<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * Lets the user enter a number.
 */
final class NumberInput extends AbstractInput
{
    public static function make(string $id): self
    {
        return new self($id);
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
