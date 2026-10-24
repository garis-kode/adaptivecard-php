<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Node;

/**
 * A selectable option within a {@see ChoiceSetInput}. Has no `type` field.
 */
final class Choice extends Node
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
