<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Represents a mentioned person or tag.
 */
final class MentionedEntity extends Node
{
    public function __construct(string $id, string $name, string $mentionType = 'Person')
    {
        $this->id($id);
        $this->name($name);
        $this->mentionType($mentionType);
    }

    public static function make(string $id, string $name, string $mentionType = 'Person'): self
    {
        return new self($id, $name, $mentionType);
    }

    /**
     * The user ID (MRI) or tag ID.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * The name of the user or tag.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The type of entity mentioned (e.g. Person, Tag).
     *
     * @param "Person"|"Tag"|string $mentionType
     */
    public function mentionType(string $mentionType): self
    {
        return $this->set('mentionType', $mentionType);
    }

    public function getType(): ?string
    {
        return null;
    }
}
