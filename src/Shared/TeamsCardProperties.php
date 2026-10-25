<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Represents a set of Teams-specific properties on a card.
 */
final class TeamsCardProperties extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add an entity mention.
     */
    public function addEntity(Mention $mention): self
    {
        return $this->push('entities', $mention);
    }

    /**
     * Add multiple entity mentions.
     *
     * @param iterable<Mention> $entities
     */
    public function addEntities(iterable $entities): self
    {
        foreach ($entities as $mention) {
            $this->addEntity($mention);
        }

        return $this;
    }

    /**
     * A list of entities mentioned in the card.
     *
     * @param iterable<Mention> $entities
     */
    public function entities(iterable $entities): self
    {
        return $this->addEntities($entities);
    }

    /**
     * Controls the width of the card when rendered in Teams.
     * Valid values: "full".
     *
     * @param "full"|string $width
     */
    public function width(string $width): self
    {
        return $this->set('width', $width);
    }

    public function getType(): ?string
    {
        return null;
    }
}
