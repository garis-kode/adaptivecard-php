<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Defines information required to enable on-behalf-of single sign-on user authentication.
 * For more information, refer to the Bot Framework TokenExchangeResource type.
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

    /**
     * A unique identifier for this token exchange resource.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * An application ID of the resource provider.
     */
    public function providerId(string $providerId): self
    {
        return $this->set('providerId', $providerId);
    }

    /**
     * The URI of the resource provider.
     */
    public function uri(string $uri): self
    {
        return $this->set('uri', $uri);
    }

    public function getType(): ?string
    {
        return null;
    }
}
