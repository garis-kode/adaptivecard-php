<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Node;

/**
 * Defines how a card can be refreshed by making a request to the target Bot.
 */
final class Refresh extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The action to be executed to refresh the card. Clients will execute this
     * action when the card is refreshed. Valid values: Action.Execute.
     */
    public function action(ExecuteAction $action): self
    {
        return $this->set('action', $action);
    }

    /**
     * A timestamp indicating when the card expires.
     */
    public function expires(string $expires): self
    {
        return $this->set('expires', $expires);
    }

    /**
     * A list of user MRIs for whom the card is refreshed automatically on display.
     *
     * @param list<string> $userIds
     */
    public function userIds(array $userIds): self
    {
        return $this->set('userIds', $userIds);
    }

    public function getType(): ?string
    {
        return null;
    }
}
