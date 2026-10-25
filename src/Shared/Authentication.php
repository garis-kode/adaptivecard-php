<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Defines authentication information associated with a card. For more
 * information, refer to the Bot Framework OAuthCard type.
 */
final class Authentication extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The text to display when prompting a user to authenticate.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * The name of the OAuth connection to use.
     */
    public function connectionName(string $connectionName): self
    {
        return $this->set('connectionName', $connectionName);
    }

    /**
     * Defines information required to enable on-behalf-of single sign-on user authentication.
     */
    public function tokenExchangeResource(TokenExchangeResource $resource): self
    {
        return $this->set('tokenExchangeResource', $resource);
    }

    /**
     * Add a button that should be displayed to the user to authenticate.
     */
    public function addButton(AuthCardButton $button): self
    {
        return $this->push('buttons', $button);
    }

    /**
     * Add multiple buttons that should be displayed to the user to authenticate.
     *
     * @param iterable<AuthCardButton> $buttons
     */
    public function addButtons(iterable $buttons): self
    {
        foreach ($buttons as $button) {
            $this->addButton($button);
        }

        return $this;
    }

    /**
     * Buttons that should be displayed to the user to authenticate.
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
