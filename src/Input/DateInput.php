<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * An input to allow the user to select a date.
 */
final class DateInput extends AbstractInput
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
     * The default value of the input, in the `YYYY-MM-DD` format.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The text to display as a placeholder when the user has not selected a date.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * The minimum date that can be selected.
     */
    public function min(string $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The maximum date that can be selected.
     */
    public function max(string $max): self
    {
        return $this->set('max', $max);
    }

    public function getType(): string
    {
        return 'Input.Date';
    }
}
