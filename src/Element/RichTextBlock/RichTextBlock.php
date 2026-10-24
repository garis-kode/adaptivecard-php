<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Element\AbstractElement;

/**
 * Displays rich inline content composed of styled {@see TextRun}s, {@see IconRun}s,
 * {@see ImageRun}s and/or plain strings.
 */
final class RichTextBlock extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Append an inline. Strings are added verbatim (unstyled runs); Run
     * objects carry their own styling.
     */
    public function addInline(TextRun|IconRun|ImageRun|string $inline): self
    {
        return $this->push('inlines', $inline);
    }

    public function addTextRun(string $text, ?callable $configure = null): self
    {
        $run = new TextRun($text);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
    }

    public function addIconRun(string $name, ?callable $configure = null): self
    {
        $run = new IconRun($name);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
    }

    public function addImageRun(string $url, ?callable $configure = null): self
    {
        $run = new ImageRun($url);
        if ($configure !== null) {
            $configure($run);
        }

        return $this->addInline($run);
    }

    public function getType(): string
    {
        return 'RichTextBlock';
    }
}
