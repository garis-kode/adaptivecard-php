<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Element\Inline\TextRun;
use AdaptiveCards\Enum\HorizontalAlignment;

/**
 * Displays rich inline content composed of styled {@see TextRun}s and/or
 * plain strings.
 */
final class RichTextBlock extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Append an inline. Strings are added verbatim (unstyled runs); TextRun
     * objects carry their own styling.
     */
    public function addInline(TextRun|string $inline): self
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

    public function horizontalAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalAlignment', HorizontalAlignment::value($alignment));
    }

    public function getType(): string
    {
        return 'RichTextBlock';
    }
}
