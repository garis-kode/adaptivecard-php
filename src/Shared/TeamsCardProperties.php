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
     * The Teams-specific entities associated with the card.
     * Valid values: "mention".
     *
     * @param iterable<Mention> $entities
     */
    public function entities(iterable $entities): self
    {
        return $this->addEntities($entities);
    }

    /**
     * Controls the width of the card in a Teams chat. Note that setting width to `"full"`
     * will not actually stretch the card to the "full width" of the chat pane. It will only
     * make the card wider than when the width property isn't set.
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
