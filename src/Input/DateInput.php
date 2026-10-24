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
     * Description of the input desired. Displayed when no selection has been made.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * The earliest date that may be selected, expressed as YYYY-MM-DD.
     */
    public function min(string $min): self
    {
        return $this->set('min', $min);
    }

    /**
     * The latest date that may be selected, expressed as YYYY-MM-DD.
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
