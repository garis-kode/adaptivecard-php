<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Node;

/**
 * A single title/value pair inside a {@see FactSet}. Has no `type` field.
 */
final class Fact extends Node
{
    public function __construct(string $title, string $value)
    {
        $this->set('title', $title);
        $this->set('value', $value);
    }

    public static function make(string $title, string $value): self
    {
        return new self($title, $value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
