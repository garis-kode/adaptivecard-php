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
     * @param TokenExchangeResource|array<string, mixed> $resource
     */
    public function tokenExchangeResource(TokenExchangeResource|array $resource): self
    {
        return $this->set('tokenExchangeResource', $resource);
    }

    /**
     * @param AuthCardButton|array<string, mixed> $button
     */
    public function addButton(AuthCardButton|array $button): self
    {
        return $this->push('buttons', $button);
    }

    /**
     * @param iterable<AuthCardButton|array<string, mixed>> $buttons
     */
    public function buttons(iterable $buttons): self
    {
        foreach ($buttons as $button) {
            $this->addButton($button);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return null;
    }
}
