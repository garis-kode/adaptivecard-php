<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Enum\AssociatedInputs;
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
        string|AssociatedInputs|null $associatedInputs = null,
    ) {
        if ($dataset !== null) {
            $this->dataset($dataset);
        }
        if ($value !== null) {
            $this->value($value);
        }
        if ($count !== null) {
            $this->count($count);
        }
        if ($skip !== null) {
            $this->skip($skip);
        }
        if ($associatedInputs !== null) {
            $this->associatedInputs($associatedInputs);
        }
    }

    public static function make(
        ?string $dataset = null,
        ?string $value = null,
        ?int $count = null,
        ?int $skip = null,
        string|AssociatedInputs|null $associatedInputs = null,
    ): self {
        return new self($dataset, $value, $count, $skip, $associatedInputs);
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

    public function associatedInputs(string|AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', AssociatedInputs::value($associatedInputs));
    }

    public function getType(): string
    {
        return 'Data.Query';
    }
}
