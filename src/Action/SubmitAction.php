<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Action\Submit\SubmitActionData;
use AdaptiveCards\Action\Submit\TeamsSubmitActionProperties;
use AdaptiveCards\Enum\AssociatedInputs;

/**
 * Gathers input values, merges them with the `data` property if specified,
 * and sends them to the Bot via an Invoke activity. The Bot can only acknowledge
 * it has received the request.
 */
final class SubmitAction extends AbstractAction
{
    public function __construct(?string $title = null)
    {
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(?string $title = null): self
    {
        return new self($title);
    }

    /**
     * The data to send to the Bot when the action is executed. When expressed as an object, `data`
     * is sent back to the Bot when the action is executed, adorned with the values of the inputs
     * expressed as key/value pairs, where the key is the Id of the input. If `data` is expressed as
     * a string, input values are not sent to the Bot. 
     * Valid values: "SubmitActionData".
     */
    public function data(SubmitActionData $data): self
    {
        return $this->set('data', $data);
    }

    /**
     * The Ids of the inputs associated with the Action.Submit. When the action is executed,
     * the values of the associated inputs are sent to the Bot.
     * Valid values: "auto", "none".
     */
    public function associatedInputs(AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', $associatedInputs->value);
    }

    /**
     * Teams-specific metadata associated with the action.
     * Valid values: "TeamsSubmitActionProperties".
     */
    public function msteams(TeamsSubmitActionProperties $properties): self
    {
        return $this->set('msteams', $properties);
    }

    public function getType(): string
    {
        return 'Action.Submit';
    }
}
