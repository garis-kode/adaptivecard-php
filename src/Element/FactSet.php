<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

/**
 * Displays a series of title/value {@see Fact} pairs.
 */
final class FactSet extends AbstractElement
{
    /**
     * @param array<string, string>|list<Fact> $facts Either an associative
     *        title => value map or a list of Fact objects.
     */
    public function __construct(array $facts = [])
    {
        foreach ($facts as $key => $value) {
            if ($value instanceof Fact) {
                $this->addFact($value);
            } else {
                $this->addFact(new Fact((string) $key, (string) $value));
            }
        }
    }

    /**
     * @param array<string, string>|list<Fact> $facts
     */
    public static function make(array $facts = []): self
    {
        return new self($facts);
    }

    public function addFact(Fact $fact): self
    {
        return $this->push('facts', $fact);
    }

    public function fact(string $title, string $value): self
    {
        return $this->addFact(new Fact($title, $value));
    }

    public function getType(): string
    {
        return 'FactSet';
    }
}
