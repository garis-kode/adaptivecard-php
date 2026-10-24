<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

/**
 * A formatted and syntax-colored code block.
 */
final class CodeBlock extends AbstractElement
{
    public function __construct(
        ?string $codeSnippet = null,
        string $language = 'PlainText',
        ?int $startLineNumber = null,
    ) {
        $this->set('codeSnippet', $codeSnippet);
        $this->set('language', $language);
        $this->set('startLineNumber', $startLineNumber);
    }

    public static function make(
        ?string $codeSnippet = null,
        string $language = 'PlainText',
        ?int $startLineNumber = null,
    ): self {
        return new self($codeSnippet, $language, $startLineNumber);
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
