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
     * The default value of the string, which is used when no matching localized value is found.
     */
    public function defaultValue(string $defaultValue): self
    {
        return $this->set('defaultValue', $defaultValue);
    }

    /**
     * Localized values of the string, where keys represent the locale (e.g. en-US) in the
     * `<ISO 639-1>(-<ISO 3166-1 alpha-2>)` format. `<ISO 639-1>` is the 2-letter language
     * code and `<ISO 3166-1 alpha-2>` is the optional 2-letter country code.
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
