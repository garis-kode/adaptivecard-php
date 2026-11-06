<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Element\AbstractInlineElement;

/**
 * A citation inside a RichTextBlock element.
 */
final class CitationRun extends AbstractInlineElement
{
    public function __construct(string $text, int $referenceIndex)
    {
        $this->text($text);
        $this->referenceIndex($referenceIndex);
    }

    public static function make(string $text, int $referenceIndex): self
    {
        return new self($text, $referenceIndex);
    }

    /**
     * The text to display. A subset of markdown is supported.
     */
    public function text(string $text): self
    {
        return $this->set('text', $text);
    }

    /**
     * Defines an expression whose evaluated value will be used to update the `text` property of the
     * TextBlock at runtime.
     */
    public function textDynamic(string $expression): self
    {
        return $this->set('text.dynamic', $expression);
    }

    /**
     * The index of the reference to be cited. Indexing starts at 1.
     */
    public function referenceIndex(int $referenceIndex): self
    {
        return $this->set('referenceIndex', $referenceIndex);
    }

    public function getType(): string
    {
        return 'CitationRun';
    }
}
