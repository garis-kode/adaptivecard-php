<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Represents a mention of a person or tag within a Teams card.
 */
final class Mention extends Node
{
    public function __construct(string $text, MentionedEntity $mentioned)
    {
        $this->set('text', $text);
        $this->set('mentioned', $mentioned);
    }

    public static function make(string $text, MentionedEntity $mentioned): self
    {
        return new self($text, $mentioned);
    }

    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    public function mentioned(MentionedEntity $mentioned): self
    {
        return $this->set('mentioned', $mentioned);
    }

    public function getType(): string
    {
        return 'mention';
    }
}
