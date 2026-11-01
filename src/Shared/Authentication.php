<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Defines authentication information associated with a card.
 */
final class Authentication extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The text that can be displayed to the end user when prompting them to authenticate.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * The identifier for registered OAuth connection setting information.
     */
    public function connectionName(string $connectionName): self
    {
        return $this->set('connectionName', $connectionName);
    }

    /**
     * Provides information required to enable on-behalf-of single sign-on user authentication.
     * Valid values: "TokenExchangeResource".
     */
    public function tokenExchangeResource(TokenExchangeResource $resource): self
    {
        return $this->set('tokenExchangeResource', $resource);
    }

    /**
     * Add a button that should be displayed to the user to authenticate.
     *
     * @param AuthCardButton|iterable<AuthCardButton> $button
     */
    public function addButtons(AuthCardButton|iterable $button): self
    {
        if (is_iterable($button)) {
            foreach ($button as $item) {
                $this->push('buttons', $item);
            }

            return $this;
        }

        return $this->push('buttons', $button);
    }

    /**
     * The buttons that should be displayed to the user when prompting for authentication.
     * The array MUST contain one button of type "signin". Other button types are not
     * currently supported.
     * Valid values: "AuthCardButton".
     *
     * @param iterable<AuthCardButton> $buttons
     */
    public function buttons(iterable $buttons): self
    {
        return $this->addButtons($buttons);
    }

    public function getType(): ?string
    {
        return null;
    }
}
