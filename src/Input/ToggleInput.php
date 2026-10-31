<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * An input to allow the user to select between on/off states.
 */
final class ToggleInput extends AbstractInput
{
    public function __construct(string $id, ?string $title = null)
    {
        parent::__construct($id);
    
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(string $id, ?string $title = null): self
    {
        return new self($id, $title);
    }

    /**
     * The title (caption) to display next to the toggle.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * Controls whether the title is visually displayed. When set to false, the title is
     * hidden from view but remains accessible to screen readers for accessibility purposes.
     */
    public function showTitle(bool $show = true): self
    {
        return $this->set('showTitle', $show);
    }

    /**
     * The default value of the input.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The value to send to the Bot when the toggle is on.
     */
    public function valueOn(string $valueOn): self
    {
        return $this->set('valueOn', $valueOn);
    }

    /**
     * The value to send to the Bot when the toggle is off.
     */
    public function valueOff(string $valueOff): self
    {
        return $this->set('valueOff', $valueOff);
    }

    /**
     * Controls if the title should wrap.
     */
    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    public function getType(): string
    {
        return 'Input.Toggle';
    }
}
