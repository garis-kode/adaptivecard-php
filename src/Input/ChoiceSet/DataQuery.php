<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Enum\AssociatedInputs;
use AdaptiveCards\Node;

/**
 * Defines a dynamic data query for choice sets (e.g. People Picker via Graph).
 */
final class DataQuery extends Node
{
    public function __construct(
        ?string $dataset = null,
        ?string $value = null,
        ?int $count = null,
        ?int $skip = null,
        ?AssociatedInputs $associatedInputs = null,
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
        ?AssociatedInputs $associatedInputs = null,
    ): self {
        return new self($dataset, $value, $count, $skip, $associatedInputs);
    }

    /**
     * The dataset to query.
     */
    public function dataset(string $dataset): self
    {
        return $this->set('dataset', $dataset);
    }

    /**
     * The search query string.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The maximum number of items to return.
     */
    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    /**
     * The number of items to skip.
     */
    public function skip(int $skip): self
    {
        return $this->set('skip', $skip);
    }

    /**
     * Controls which inputs are associated with the query.
     * Valid values: "auto", "none".
     */
    public function associatedInputs(AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', $associatedInputs->value);
    }

    public function getType(): string
    {
        return 'Data.Query';
    }
}
