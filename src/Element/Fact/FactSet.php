<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Fact;

use AdaptiveCards\Element\AbstractElement;

/**
 * A set of facts, displayed as a table or a vertical list when horizontal space is constrained.
 */
final class FactSet extends AbstractElement
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    /**
     * The array of Fact's.
     *
     * @param array<string, string>|list<Fact> $facts Either an associative
     *        title => value map or a list of Fact objects.
     */
    public function facts(array $facts): self
    {
        foreach ($facts as $key => $value) {
            if ($value instanceof Fact) {
                $this->addFact($value);
            } else {
                $this->fact((string) $key, $value);
            }
        }

        return $this;
    }

    /**
     * Add a Fact to the set.
     */
    public function addFact(Fact $fact): self
    {
        return $this->push('facts', $fact);
    }

    /**
     * Add a Fact from a title and value.
     */
    public function fact(string $title, string $value): self
    {
        return $this->addFact(new Fact($title, $value));
    }

    public function getType(): string
    {
        return 'FactSet';
    }
}
