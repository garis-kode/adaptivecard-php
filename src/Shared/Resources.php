<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Resources card elements can reference.
 */
final class Resources extends Node
{
    public static function make(): self
    {
        return new self();
    }

    public function addString(string $id, StringResource $stringResource): self
    {
        /** @var array<string, StringResource> $strings */
        $strings = $this->properties['strings'] ?? [];
        $strings[$id] = $stringResource;
        $this->properties['strings'] = $strings;

        return $this;
    }

    /**
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
