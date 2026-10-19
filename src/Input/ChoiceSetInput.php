<?php

declare(strict_types=1);

namespace AdaptiveCards\Input;

use AdaptiveCards\Enum\ChoiceInputStyle;

/**
 * Lets the user select from a set of {@see Choice}s (dropdown, radio or
 * multi-select).
 */
final class ChoiceSetInput extends AbstractInput
{
    public static function make(string $id): self
    {
        return new self($id);
    }

    public function addChoice(Choice $choice): self
    {
        return $this->push('choices', $choice);
    }

    public function choice(string $title, string $value): self
    {
        return $this->addChoice(new Choice($title, $value));
    }

    /**
     * Add several choices from a title => value map.
     *
     * @param array<string, string> $choices
     */
    public function choices(array $choices): self
    {
        foreach ($choices as $title => $value) {
            $this->choice((string) $title, (string) $value);
        }

        return $this;
    }

    public function isMultiSelect(bool $multiSelect = true): self
    {
        return $this->set('isMultiSelect', $multiSelect);
    }

    public function style(string|ChoiceInputStyle $style): self
    {
        return $this->set('style', ChoiceInputStyle::value($style));
    }

    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    public function getType(): string
    {
        return 'Input.ChoiceSet';
    }
}
