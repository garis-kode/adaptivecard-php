<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Element\AbstractInlineElement;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * A rich text block that displays formatted text.
 */
final class RichTextBlock extends AbstractBlockElement
{
    use HasHeight, HasHorizontalAlignment, HasSpacing;

    /**
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public function __construct(AbstractInlineElement|iterable|null ...$inlines)
    {
        if (!empty($inlines)) {
            $this->addInlines(...$inlines);
        }
    }

    /**
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public static function make(AbstractInlineElement|iterable|null ...$inlines): self
    {
        return new self(...$inlines);
    }

    /**
     * Append an inline run.
     */
    public function addInline(AbstractInlineElement $inline): self
    {
        return $this->push('inlines', $inline);
    }

    /**
     * Append one or more inlines (accepts variadic items or an array/iterable).
     *
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public function addInlines(AbstractInlineElement|iterable|null ...$inlines): self
    {
        foreach ($inlines as $inline) {
            if ($inline === null) {
                continue;
            }

            if (is_iterable($inline)) {
                foreach ($inline as $item) {
                    if ($item instanceof AbstractInlineElement) {
                        $this->addInline($item);
                    }
                }
            } else {
                $this->addInline($inline);
            }
        }

        return $this;
    }

    /**
     * The inlines making up the rich text block.
     * Valid values: "TextRun", "IconRun", "ImageRun", "CitationRun".
     *
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public function inlines(AbstractInlineElement|iterable|null ...$inlines): self
    {
        return $this->addInlines(...$inlines);
    }

    /**
     * The Id of the input the RichTextBlock should act as the label of.
     */
    public function labelFor(string $inputId): self
    {
        return $this->set('labelFor', $inputId);
    }

    public function getType(): string
    {
        return 'RichTextBlock';
    }
}
