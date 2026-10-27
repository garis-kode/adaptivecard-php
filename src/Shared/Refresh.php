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
     * The `Action.Execute` action to invoke to refresh the card.
     * Valid values: Action.Execute.
     */
    public function action(ExecuteAction $action): self
    {
        return $this->set('action', $action);
    }

    /**
     * The list of user Ids for which the card will be automatically refreshed. In Teams,
     * in chats or channels with more than 60 users, the card will automatically refresh
     * only for users specified in the `userIds` list. Other users will have to manually
     * click on a "refresh" button. In contexts with fewer than 60 users, the card will
     * automatically refresh for all users.
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
