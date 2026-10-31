<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

trait HasKey
{
    /**
     * Defines an optional key for the object. Keys are seldom needed, but in
     * some scenarios, specifying keys can help maintain visual state in the
     * host application.
     */
    public function key(string $key): static
    {
        return $this->set('key', $key);
    }
}
