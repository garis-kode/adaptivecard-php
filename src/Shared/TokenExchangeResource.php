<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Details of the resource that can be used to acquire an auth token for the user.
 */
final class TokenExchangeResource extends Node
{
    public function __construct(
        ?string $id = null,
        ?string $providerId = null,
        ?string $uri = null,
    ) {
        if ($id !== null) {
            $this->id($id);
        }
        if ($providerId !== null) {
            $this->providerId($providerId);
        }
        if ($uri !== null) {
            $this->uri($uri);
        }
    }

    public static function make(
        ?string $id = null,
        ?string $providerId = null,
        ?string $uri = null,
    ): self {
        return new self($id, $providerId, $uri);
    }

    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    public function providerId(string $providerId): self
    {
        return $this->set('providerId', $providerId);
    }

    public function uri(string $uri): self
    {
        return $this->set('uri', $uri);
    }

    public function getType(): ?string
    {
        return null;
    }
}
