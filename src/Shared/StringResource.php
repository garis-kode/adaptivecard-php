<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Defines the replacement string values.
 */
final class StringResource extends Node
{
    /**
     * @param array<string, string> $localizedValues
     */
    public function __construct(string $defaultValue, array $localizedValues = [])
    {
        $this->defaultValue($defaultValue);
        if ($localizedValues !== []) {
            $this->localizedValues($localizedValues);
        }
    }

    /**
     * @param array<string, string> $localizedValues
     */
    public static function make(string $defaultValue, array $localizedValues = []) : self
    {
        return new self($defaultValue, $localizedValues);
    }

    /**
     * The default string to display if a localized string is not available for the host application's language.
     */
    public function defaultValue(string $defaultValue): self
    {
        return $this->set('defaultValue', $defaultValue);
    }

    /**
     * A map of locale to localized string values.
     *
     * @param array<string, string> $localizedValues
     */
    public function localizedValues(array $localizedValues): self
    {
        return $this->set('localizedValues', $localizedValues);
    }

    /**
     * Add a localized value for a specific locale.
     */
    public function addLocalizedValue(string $locale, string $value): self
    {
        /** @var array<string, string> $existing */
        $existing = $this->properties['localizedValues'] ?? [];
        $existing[$locale] = $value;
        $this->properties['localizedValues'] = $existing;

        return $this;
    }

    public function getType(): ?string
    {
        return null;
    }
}
