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
    use HasHeight;
    use HasHorizontalAlignment;
    use HasSpacing;

    /**
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public function __construct(AbstractInlineElement|iterable|null ...$inlines)
    {
        foreach ($inlines as $inline) {
            if ($inline !== null) {
                $this->addInlines($inline);
            }
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
     * Add inlines making up the rich text block.
     *
     * @param AbstractInlineElement|iterable<AbstractInlineElement> $inline
     */
    public function addInlines(AbstractInlineElement|iterable $inline): self
    {
        if (is_iterable($inline)) {
            foreach ($inline as $item) {
                $this->push('inlines', $item);
            }

            return $this;
        }

        return $this->push('inlines', $inline);
    }

    /**
     * The inlines making up the rich text block.
     * Valid values: "TextRun", "IconRun", "ImageRun", "CitationRun".
     *
     * @param AbstractInlineElement|iterable<AbstractInlineElement>|null ...$inlines
     */
    public function inlines(AbstractInlineElement|iterable|null ...$inlines): self
    {
        foreach ($inlines as $inline) {
            if ($inline !== null) {
                $this->addInlines($inline);
            }
        }

        return $this;
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
