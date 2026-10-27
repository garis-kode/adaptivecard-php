<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Fact;

use AdaptiveCards\Node;

/**
 * A fact in a FactSet element.
 */
final class Fact extends Node
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
     * The fact's title.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The fact's value.
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
