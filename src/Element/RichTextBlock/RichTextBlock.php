<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Element\AbstractElement;

/**
 * A rich text block that displays formatted text.
 */
final class RichTextBlock extends AbstractElement
{
    /**
     * @param iterable<TextRun|IconRun|ImageRun|string>|null $inlines
     */
    public function __construct(?iterable $inlines = null)
    {
        if ($inlines !== null) {
            $this->inlines($inlines);
        }
    }

    /**
     * @param iterable<TextRun|IconRun|ImageRun|string>|null $inlines
     */
    public static function make(?iterable $inlines = null): self
    {
        return new self($inlines);
    }

    /**
     * The list of inlines to display.
     *
     * @param iterable<TextRun|IconRun|ImageRun|string> $inlines
     */
    public function inlines(iterable $inlines): self
    {
        foreach ($inlines as $inline) {
            $this->addInline($inline);
        }

        return $this;
    }

    /**
     * Append an inline. Strings are added verbatim (unstyled runs); Run
     * objects carry their own styling.
     */
    public function addInline(TextRun|IconRun|ImageRun|string $inline): self
    {
        return $this->push('inlines', $inline);
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
     * A string identifier representing the input element that this text block provides a label for.
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
