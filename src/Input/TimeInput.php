<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * An input to allow the user to select a time.
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

    /**
     * The default value of the input, in the `HH:MM` format.
     */
    public function value(string $value): self
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
     * The minimum time that can be selected, in the `HH:MM` format.
     */
    public function min(string $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The maximum time that can be selected, in the `HH:MM` format.
     */
    public function max(string $max): self
    {
        return $this->set('max', $max);
    }

    public function getType(): string
    {
        return 'Input.Time';
    }
}
