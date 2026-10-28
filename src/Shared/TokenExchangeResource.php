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
     * The unique identified of this token exchange instance.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * An identifier for the identity provider with which to attempt a token exchange.
     */
    public function providerId(string $providerId): self
    {
        return $this->set('providerId', $providerId);
    }

    /**
     * An application ID or resource identifier with which to exchange a token on behalf
     * of. This property is identity provider- and application-specific.
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
