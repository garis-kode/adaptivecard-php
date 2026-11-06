<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents the properties of a file component.
 */
final class FileProperties extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The file extension.
     */
    public function extension(string $extension): self
    {
        return $this->set('extension', $extension);
    }

    /**
     * The name of the file.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The URL of the file.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): ?string
    {
        return null;
    }
}
