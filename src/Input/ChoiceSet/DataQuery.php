<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Node;

/**
 * Dynamic data query specification for ChoiceSetInput.
 */
final class DataQuery extends Node
{
    public function __construct(
        ?string $dataset = null,
        ?string $value = null,
        ?int $count = null,
        ?int $skip = null,
    ) {
        $this->set('dataset', $dataset);
        $this->set('value', $value);
        $this->set('count', $count);
        $this->set('skip', $skip);
    }

    public static function make(
        ?string $dataset = null,
        ?string $value = null,
        ?int $count = null,
        ?int $skip = null,
    ): self {
        return new self($dataset, $value, $count, $skip);
    }

    public function dataset(string $dataset): self
    {
        return $this->set('dataset', $dataset);
    }

    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    public function skip(int $skip): self
    {
        return $this->set('skip', $skip);
    }

    public function getType(): string
    {
        return 'Data.Query';
    }
}
