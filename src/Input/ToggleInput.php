<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

/**
 * A single on/off checkbox-style input.
 */
final class ToggleInput extends AbstractInput
{
    public function __construct(string $id, string $title)
    {
        parent::__construct($id);
        $this->set('title', $title);
    }

    public static function make(string $id, string $title): self
    {
        return new self($id, $title);
    }

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function valueOn(string $valueOn): self
    {
        return $this->set('valueOn', $valueOn);
    }

    public function valueOff(string $valueOff): self
    {
        return $this->set('valueOff', $valueOff);
    }

    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    public function getType(): string
    {
        return 'Input.Toggle';
    }
}
