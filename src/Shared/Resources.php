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
     * String resources that can provide translations in multiple languages. String resources
     * make it possible to craft cards that are automatically localized according to the
     * language settings of the application that displays the card.
     * Valid values: "StringResource".
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
