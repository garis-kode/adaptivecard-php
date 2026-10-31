<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * A choice as used by the Input.ChoiceSet input.
 */
final class Choice extends Node
{
    use HasKey;

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
     * The text to display for the choice.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The value associated with the choice, as sent to the Bot when an `Action.Submit`
     * or `Action.Execute` is invoked.
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
