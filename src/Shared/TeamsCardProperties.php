<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Teams-specific metadata associated with the card.
 */
final class TeamsCardProperties extends Node
{
    public static function make(): self
    {
        return new self();
    }

    public function addEntity(Mention $mention): self
    {
        return $this->push('entities', $mention);
    }

    /**
     * @param iterable<Mention> $entities
     */
    public function entities(iterable $entities): self
    {
        foreach ($entities as $mention) {
            $this->addEntity($mention);
        }

        return $this;
    }

    /**
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
