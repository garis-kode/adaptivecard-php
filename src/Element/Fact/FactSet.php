<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Fact;

use AdaptiveCards\Element\AbstractElement;

/**
 * A set of facts, displayed as a table or a vertical list when horizontal space is constrained.
 */
final class FactSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
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

    /**
     * Add multiple facts to the set.
     *
     * @param iterable<Fact> $facts
     */
    public function addFacts(iterable $facts): self
    {
        foreach ($facts as $fact) {
            $this->addFact($fact);
        }

        return $this;
    }

    /**
     * The facts in the set.
     * Valid values: Fact.
     *
     * @param iterable<Fact> $facts
     */
    public function facts(iterable $facts): self
    {
        return $this->addFacts($facts);
    }

    public function getType(): string
    {
        return 'FactSet';
    }
}
