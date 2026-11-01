<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Fact;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasSpacing;

/**
 * A set of facts, displayed as a table or a vertical list when horizontal space is constrained.
 */
final class FactSet extends AbstractBlockElement
{
    use HasHeight, HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a Fact to the set.
     *
     * @param Fact|iterable<Fact> $fact
     */
    public function addFacts(Fact|iterable $fact): self
    {
        if (is_iterable($fact)) {
            foreach ($fact as $item) {
                $this->push('facts', $item);
            }

            return $this;
        }

        return $this->push('facts', $fact);
    }

    /**
     * Add a Fact from a title and value.
     */
    public function fact(string $title, string $value): self
    {
        return $this->addFacts(new Fact($title, $value));
    }

    /**
     * The facts in the set.
     * Valid values: "Fact".
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
