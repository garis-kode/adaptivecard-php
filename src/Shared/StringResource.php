<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Defines replacement localized string values.
 */
final class StringResource extends Node
{
    /**
     * @param array<string, string> $localizedValues
     */
    public function __construct(string $defaultValue, array $localizedValues = [])
    {
        $this->set('defaultValue', $defaultValue);
        if ($localizedValues !== []) {
            $this->set('localizedValues', $localizedValues);
        }
    }

    /**
     * @param array<string, string> $localizedValues
     */
    public static function make(string $defaultValue, array $localizedValues = []) : self
    {
        return new self($defaultValue, $localizedValues);
    }

    public function defaultValue(string $defaultValue): self
    {
        return $this->set('defaultValue', $defaultValue);
    }

    /**
     * @param array<string, string> $localizedValues
     */
    public function localizedValues(array $localizedValues): self
    {
        return $this->set('localizedValues', $localizedValues);
    }

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
