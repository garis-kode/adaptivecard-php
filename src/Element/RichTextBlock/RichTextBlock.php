<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Element\AbstractInlineElement;
use AdaptiveCards\Support\HasHorizontalAlignment;

/**
 * A rich text block that displays formatted text.
 */
final class RichTextBlock extends AbstractBlockElement
{
    use HasHorizontalAlignment;

    /**
     * @param iterable<AbstractInlineElement>|null $inlines
     */
    public function __construct(?iterable $inlines = null)
    {
        if ($inlines !== null) {
            $this->inlines($inlines);
        }
    }

    /**
     * @param iterable<AbstractInlineElement>|null $inlines
     */
    public static function make(?iterable $inlines = null): self
    {
        return new self($inlines);
    }

    /**
     * Append an inline run.
     */
    public function addInline(AbstractInlineElement $inline): self
    {
        return $this->push('inlines', $inline);
    }

    /**
     * Append multiple inlines.
     *
     * @param iterable<AbstractInlineElement> $inlines
     */
    public function addInlines(iterable $inlines): self
    {
        foreach ($inlines as $inline) {
            $this->addInline($inline);
        }

        return $this;
    }

    /**
     * The inlines making up the rich text block.
     * Valid values: "TextRun", "IconRun", "ImageRun", "CitationRun".
     *
     * @param iterable<AbstractInlineElement> $inlines
     */
    public function inlines(iterable $inlines): self
    {
        return $this->addInlines($inlines);
    }

    /**
     * Add a TextRun to the RichTextBlock.
     */
    public function addTextRun(string $text, ?callable $configure = null): self
    {
        $run = new TextRun($text);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
    }

    /**
     * Add an IconRun to the RichTextBlock.
     */
    public function addIconRun(string $name, ?callable $configure = null): self
    {
        $run = new IconRun($name);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
    }

    /**
     * Add an ImageRun to the RichTextBlock.
     */
    public function addImageRun(string $url, ?callable $configure = null): self
    {
        $run = new ImageRun($url);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
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
