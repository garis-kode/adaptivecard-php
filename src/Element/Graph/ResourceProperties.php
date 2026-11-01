<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents the properties of a resource component.
 */
final class ResourceProperties extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The Id of the resource.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * The reference to the resource.
     *
     * @param array<string, string> $resourceReference
     */
    public function resourceReference(array $resourceReference): self
    {
        return $this->set('resourceReference', $resourceReference);
    }

    /**
     * The visualization of the resource.
     * Valid values: "ResourceVisualization".
     */
    public function resourceVisualization(ResourceVisualization $resourceVisualization): self
    {
        return $this->set('resourceVisualization', $resourceVisualization);
    }

    public function getType(): ?string
    {
        return null;
    }
}
