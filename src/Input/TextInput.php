<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\TextInputStyle;

/**
 * Lets the user enter free-form text.
 */
final class TextInput extends AbstractInput
{
    public static function make(string $id): self
    {
        return new self($id);
    }

    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    public function isMultiline(bool $multiline = true): self
    {
        return $this->set('isMultiline', $multiline);
    }

    public function maxLength(int $maxLength): self
    {
        return $this->set('maxLength', $maxLength);
    }

    public function style(string|TextInputStyle $style): self
    {
        return $this->set('style', TextInputStyle::value($style));
    }

    public function regex(string $regex): self
    {
        return $this->set('regex', $regex);
    }

    public function inlineAction(AbstractAction $action): self
    {
        return $this->set('inlineAction', $action);
    }

    public function getType(): string
    {
        return 'Input.Text';
    }
}
