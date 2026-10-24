<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * Lets the user pick a time ("HH:MM").
 */
final class TimeInput extends AbstractInput
{
    public function __construct(string $id, ?string $label = null)
    {
        parent::__construct($id);
    
        if ($label !== null) {
            $this->label($label);
        }
    }

    public static function make(string $id, ?string $label = null): self
    {
        return new self($id, $label);
    }

    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    public function min(string $min): self
    {
        return $this->set('min', $min);
    }

    public function max(string $max): self
    {
        return $this->set('max', $max);
    }

    public function getType(): string
    {
        return 'Input.Time';
    }
}
