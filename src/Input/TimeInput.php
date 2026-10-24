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
     * Description of the input desired. Displayed when no time has been input.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * The earliest time that may be selected, expressed as HH:MM.
     */
    public function min(string $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The latest time that may be selected, expressed as HH:MM.
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
