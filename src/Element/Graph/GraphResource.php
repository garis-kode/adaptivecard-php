<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

/**
 * Displays information about a generic graph resource.
 */
final class GraphResource extends AbstractGraphComponent
{
    public static function make(): self
    {
        return new self();
    }

    protected function name(): string
    {
        return 'graph.microsoft.com/resource';
    }

    /**
     * The properties of the resource.
     * Valid values: "ResourceProperties".
     */
    public function properties(ResourceProperties $properties): self
    {
        return $this->set('properties', $properties);
    }
}
