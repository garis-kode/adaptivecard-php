<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

/**
 * Displays information about a file resource.
 */
final class File extends AbstractGraphComponent
{
    public static function make(): self
    {
        return new self();
    }

    protected function name(): string
    {
        return 'graph.microsoft.com/file';
    }

    /**
     * The properties of the file.
     * Valid values: "FileProperties".
     */
    public function properties(FileProperties $properties): self
    {
        return $this->set('properties', $properties);
    }
}
