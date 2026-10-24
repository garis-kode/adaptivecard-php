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
     * Description of the input desired. Displayed when no text has been input.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * If true, allow multiple lines of input.
     */
    public function isMultiline(bool $multiline = true): self
    {
        return $this->set('isMultiline', $multiline);
    }

    /**
     * Hint of maximum length characters to input.
     */
    public function maxLength(int $maxLength): self
    {
        return $this->set('maxLength', $maxLength);
    }

    /**
     * Style hint for text input.
     * Valid values: "text", "tel", "url", "email", "password".
     */
    public function style(string|TextInputStyle $style): self
    {
        return $this->set('style', TextInputStyle::value($style));
    }

    /**
     * Regular expression to validate the input against.
     */
    public function regex(string $regex): self
    {
        return $this->set('regex', $regex);
    }

    /**
     * The Inline Action for the input. Typically displayed after the text input.
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
