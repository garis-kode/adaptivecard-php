<?php

declare(strict_types=1);

namespace AdaptiveCards;

abstract class Node implements \JsonSerializable
{
    /** @var array<string, mixed> */
    protected array $properties = [];

    /**
     * The Adaptive Card `type` discriminator (e.g. "TextBlock"). Type-less
     * objects such as Fact, Choice and BackgroundImage return null.
     */
    abstract public function getType(): ?string;

    /**
     * Store a property unless the value is null (which means "leave as default").
     */
    protected function set(string $key, mixed $value): static
    {
        if ($value === null) {
            return $this;
        }

        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * Append a value onto an array-valued property (e.g. body items, actions).
     */
    protected function push(string $key, mixed $value): static
    {
        if (!isset($this->properties[$key]) || !is_array($this->properties[$key])) {
            $this->properties[$key] = [];
        }

        $this->properties[$key][] = $value;

        return $this;
    }

    /**
     * Escape hatch for properties this library does not model explicitly.
     */
    public function setProperty(string $key, mixed $value): static
    {
        return $this->set($key, $value);
    }

    /**
     * Convert the node (and its children) to a plain nested array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $out = [];
        $type = $this->getType();
        if ($type !== null) {
            $out['type'] = $type;
        }

        foreach ($this->properties as $key => $value) {
            $out[$key] = self::normalize($value);
        }

        return $out;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    private static function normalize(mixed $value): mixed
    {
        if ($value instanceof Node) {
            return $value->toArray();
        }

        if ($value instanceof \BackedEnum) {
            return $value->value;
        }

        if (is_array($value)) {
            return array_map(self::normalize(...), $value);
        }

        return $value;
    }
}
