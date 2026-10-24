<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Fact;

use AdaptiveCards\Node;

/**
 * A single title/value pair inside a {@see FactSet}. Has no `type` field.
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

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
