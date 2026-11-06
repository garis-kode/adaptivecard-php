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
     * The default value of the input.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * The choices associated with the input. Valid values: `Choice`.
     *
     * @param Choice|iterable<Choice> $choice
     */
    public function addChoices(Choice|iterable $choice): self
    {
        if (is_iterable($choice)) {
            foreach ($choice as $item) {
                $this->push('choices', $item);
            }

            return $this;
        }

        return $this->push('choices', $choice);
    }

    /**
     * Add a choice with title and value.
     */
    public function choice(string $title, string $value): self
    {
        return $this->addChoices(new Choice($title, $value));
    }

    /**
     * The choices associated with the input.
     * Valid values: "Choice".
     *
     * @param iterable<Choice> $choices
     */
    public function choices(iterable $choices): self
    {
        return $this->addChoices($choices);
    }

    /**
     * Controls whether multiple choices can be selected.
     */
    public function isMultiSelect(bool $multiSelect = true): self
    {
        return $this->set('isMultiSelect', $multiSelect);
    }

    /**
     * Controls whether the input should be displayed as a dropdown (compact) or a list
     * of radio buttons or checkboxes (expanded).
     * Valid values: "compact", "expanded", "filtered".
     */
    public function style(ChoiceInputStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * The text to display as a placeholder when the user has not entered any value.
     */
    public function placeholder(string $placeholder): self
    {
        return $this->set('placeholder', $placeholder);
    }

    /**
     * Controls if choice titles should wrap.
     */
    public function wrap(bool $wrap = true): self
    {
        return $this->set('wrap', $wrap);
    }

    /**
     * The minimum width, in pixels, for each column when using a multi-column layout. This ensures
     * that choice items remain readable even when horizontal space is limited. Default is 100 pixels.
     * Valid values: "<number>px".
     */
    public function minColumnWidth(string $width): self
    {
        return $this->set('minColumnWidth', $width);
    }

    /**
     * Controls whether choice items are arranged in multiple columns in expanded mode, or in a
     * single column. Default is false.
     */
    public function useMultipleColumns(bool $multiple = true): self
    {
        return $this->set('useMultipleColumns', $multiple);
    }

    /**
     * A Data.Query object that defines the dataset from which to dynamically fetch the choices
     * for the input.
     * Valid values: "Data.Query".
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
