<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Node;

/**
 * A choice as used by the Input.ChoiceSet input.
 */
final class Choice extends Node
{
    public function __construct(string $title, string $value)
    {
        $this->title($title);
        $this->value($value);
    }

    public static function make(string $title, string $value): self
    {
        return new self($title, $value);
    }

    /**
     * Text to display.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The raw value for the choice.
     * NOTE: do not use a ',' in the value, since a ChoiceSet input value when compact may contain ','.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
