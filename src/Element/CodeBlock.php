<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

/**
 * A formatted and syntax-colored code block.
 */
final class CodeBlock extends AbstractElement
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    public function codeSnippet(string $codeSnippet): self
    {
        return $this->set('codeSnippet', $codeSnippet);
    }

    public function language(string $language): self
    {
        return $this->set('language', $language);
    }

    public function startLineNumber(int $startLineNumber): self
    {
        return $this->set('startLineNumber', $startLineNumber);
    }

    public function getType(): string
    {
        return 'CodeBlock';
    }
}
