<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\TextInputStyle;

/**
 * An input to allow the user to enter text.
 */
final class TextInput extends AbstractInput
{
    public function __construct(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
    ) {
        parent::__construct($id);
        if ($label !== null) {
            $this->label($label);
        }
        if ($placeholder !== null) {
            $this->placeholder($placeholder);
        }
    }

    public static function make(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
    ): self {
        return new self($id, $label, $placeholder);
    }

    /**
     * The text to display as a placeholder when the user hasn't entered a value.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * Controls if the input should allow multiple lines of text.
     */
    public function isMultiline(bool $multiline = true): self
    {
        return $this->set('isMultiline', $multiline);
    }

    /**
     * The maximum length of the text in the input.
     */
    public function maxLength(int $maxLength): self
    {
        return $this->set('maxLength', $maxLength);
    }

    /**
     * The style of the input.
     * Valid values: "Text", "Tel", "Url", "Email", "Password".
     */
    public function style(TextInputStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * The regular expression to validate the input.
     */
    public function regex(string $regex): self
    {
        return $this->set('regex', $regex);
    }

    /**
     * The action that should be displayed as a button alongside the input.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl",
     * "Action.OpenUrlDialog", "Action.Popover", "Action.ResetInputs", "Action.RunCommands",
     * "Action.Submit", "Action.ToggleVisibility".
     */
    public function inlineAction(AbstractAction $action): self
    {
        return $this->set('inlineAction', $action);
    }

    public function getType(): string
    {
        return 'Input.Text';
    }
}
