<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents Teams-specific data in an Action.Submit to send a message back to the Bot.
 */
final class MessageBackSubmitActionData extends Node implements TeamsSubmitActionDataInterface
{
    public function __construct(?string $text = null, mixed $value = null, ?string $displayText = null)
    {
        if ($text !== null) {
            $this->text($text);
        }

        if ($value !== null) {
            $this->value($value);
        }

        if ($displayText !== null) {
            $this->displayText($displayText);
        }
    }

    public static function make(?string $text = null, mixed $value = null, ?string $displayText = null): self
    {
        return new self($text, $value, $displayText);
    }

    /**
     * The text that will be sent to the Bot.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Optional additional value that will be sent to the Bot. For instance, `value`
     * can encode specific context for the action, such as unique identifiers or a JSON object.
     */
    public function value(mixed $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The optional text that will be displayed as a new message in the conversation,
     * as if the end-user sent it. `displayText` is not sent to the Bot.
     */
    public function displayText(string $displayText): self
    {
        return $this->set('displayText', $displayText);
    }

    public function getType(): string
    {
        return 'messageBack';
    }
}
