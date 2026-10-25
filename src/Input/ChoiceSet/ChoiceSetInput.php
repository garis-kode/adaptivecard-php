<?php

declare(strict_types=1);

namespace AdaptiveCards\Input\ChoiceSet;

use AdaptiveCards\Enum\ChoiceInputStyle;
use AdaptiveCards\Input\AbstractInput;

/**
 * An input to allow the user to select one or more values.
 */
final class ChoiceSetInput extends AbstractInput
{
    public static function make(string $id): self
    {
        return new self($id);
    }

    /**
     * Add a choice to the set.
     */
    public function addChoice(Choice $choice): self
    {
        return $this->push('choices', $choice);
    }

    /**
     * Add a choice with title and value.
     */
    public function choice(string $title, string $value): self
    {
        return $this->addChoice(new Choice($title, $value));
    }

    /**
     * Add multiple choices to the set.
     *
     * @param iterable<Choice> $choices
     */
    public function addChoices(iterable $choices): self
    {
        foreach ($choices as $choice) {
            $this->addChoice($choice);
        }

        return $this;
    }

    /**
     * Choice options.
     *
     * @param iterable<Choice> $choices
     */
    public function choices(iterable $choices): self
    {
        return $this->addChoices($choices);
    }

    /**
     * Allow multiple choices to be selected.
     */
    public function isMultiSelect(bool $multiSelect = true): self
    {
        return $this->set('isMultiSelect', $multiSelect);
    }

    /**
     * Controls the visual style of the choice set.
     * Valid values: "compact", "expanded", "filtered".
     */
    public function style(ChoiceInputStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Description of the input desired. Displayed when no selection has been made.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * If true, allow text to wrap. Otherwise, text is clipped.
     */
    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    /**
     * The minimum width, in pixels, of a column when multiple columns are used.
     */
    public function minColumnWidth(string $width): self
    {
        return $this->set('minColumnWidth', $width);
    }

    /**
     * Controls whether choices should be displayed across multiple columns.
     */
    public function useMultipleColumns(bool $multiple = true): self
    {
        return $this->set('useMultipleColumns', $multiple);
    }

    /**
     * Defines a dynamic data query for choice sets (e.g. People Picker via Graph).
     */
    public function dataQuery(DataQuery $dataQuery): self
    {
        return $this->set('choices.data', $dataQuery);
    }

    public function getType(): string
    {
        return 'Input.ChoiceSet';
    }
}
