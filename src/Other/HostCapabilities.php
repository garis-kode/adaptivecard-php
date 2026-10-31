<?php

declare(strict_types=1);

namespace AdaptiveCards\Other;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a list of versioned capabilities a host application must support.
 */
final class HostCapabilities extends Node
{
    use HasKey;

    /**
     * @param array<string, string> $capabilities
     */
    public function __construct(array $capabilities = [])
    {
        $this->with($capabilities);
    }

    /**
     * @param array<string, string> $capabilities
     */
    public static function make(array $capabilities = []): self
    {
        return new self($capabilities);
    }

    /**
     * Set a required capability and its minimum version.
     */
    public function capability(string $name, string $version): self
    {
        return $this->set($name, $version);
    }

    /**
     * Merge multiple capability version requirements into the object.
     *
     * @param array<string, string> $capabilities
     */
    public function with(array $capabilities): self
    {
        foreach ($capabilities as $name => $version) {
            $this->set($name, $version);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return null;
    }
}
