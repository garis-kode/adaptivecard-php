<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * The resources that can be used in the body of the card.
 */
final class Resources extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a replacement string value.
     */
    public function addString(string $id, StringResource $stringResource): self
    {
        /** @var array<string, StringResource> $strings */
        $strings = $this->properties['strings'] ?? [];
        $strings[$id] = $stringResource;
        $this->properties['strings'] = $strings;

        return $this;
    }

    /**
     * The replacement string values.
     *
     * @param array<string, StringResource> $strings
     */
    public function strings(array $strings): self
    {
        return $this->set('strings', $strings);
    }

    public function getType(): ?string
    {
        return null;
    }
}
