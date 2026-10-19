<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * OAuth/SSO sign-in details for a card (schema 1.4+). Has no `type` field.
 */
final class Authentication extends Node
{
    public static function make(): self
    {
        return new self();
    }

    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    public function connectionName(string $connectionName): self
    {
        return $this->set('connectionName', $connectionName);
    }

    /**
     * @param array<string, mixed> $resource
     */
    public function tokenExchangeResource(array $resource): self
    {
        return $this->set('tokenExchangeResource', $resource);
    }

    /**
     * @param list<array<string, mixed>> $buttons
     */
    public function buttons(array $buttons): self
    {
        return $this->set('buttons', $buttons);
    }

    public function getType(): ?string
    {
        return null;
    }
}
