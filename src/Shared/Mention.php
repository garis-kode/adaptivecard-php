<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Represents a mention to a person.
 */
final class Mention extends Node
{
    public function __construct(string $text, MentionedEntity $mentioned)
    {
        $this->text($text);
        $this->mentioned($mentioned);
    }

    public static function make(string $text, MentionedEntity $mentioned): self
    {
        return new self($text, $mentioned);
    }

    /**
     * The text that will be substituted with the mention.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Defines the entity being mentioned.
     * Valid values: MentionedEntity.
     */
    public function mentioned(MentionedEntity $mentioned): self
    {
        return $this->set('mentioned', $mentioned);
    }

    public function getType(): string
    {
        return 'mention';
    }
}
