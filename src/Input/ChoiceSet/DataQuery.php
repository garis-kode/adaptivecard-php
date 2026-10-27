<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Enum\AssociatedInputs;
use AdaptiveCards\Node;

/**
 * Defines a query to dynamically fetch data from a Bot.
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
     * The dataset from which to fetch the data.
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
     * The maximum number of data items that should be returned by the query.
     * Card authors should not specify this property in their card payload.
     * It is determined by the client and sent to the Bot to enable pagination.
     */
    public function count(int $count): self
    {
        return $this->set('count', $count);
    }

    /**
     * The number of data items to be skipped by the query.
     * Card authors should not specify this property in their card payload.
     * It is determined by the client and sent to the Bot to enable pagination.
     */
    public function skip(int $skip): self
    {
        return $this->set('skip', $skip);
    }

    /**
     * Controls which inputs are associated with the Data.Query. When a Data.Query
     * is executed, the values of the associated inputs are sent to the Bot, allowing
     * it to perform filtering operations based on the user's input.
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
