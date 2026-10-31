<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\CodeBlockLanguage;
use AdaptiveCards\Support\HasHorizontalAlignment;

/**
 * A formatted and syntax-colored code block.
 */
final class CodeBlock extends AbstractBlockElement
{
    use HasHorizontalAlignment;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The code snippet to display.
     */
    public function codeSnippet(string $codeSnippet): self
    {
        return $this->set('codeSnippet', $codeSnippet);
    }

    /**
     * The language the code snippet is expressed in.
     * Valid values: "Bash", "C", "Cpp", "CSharp", "Css", "Dos", "Go", "Graphql",
     * "Html", "Java", "JavaScript", "Json", "ObjectiveC", "Perl", "Php", "PlainText",
     * "PowerShell", "Python", "Sql", "TypeScript", "VbNet", "Verilog", "Vhdl", "Xml".
     */
    public function language(CodeBlockLanguage $language): self
    {
        return $this->set('language', $language->value);
    }

    /**
     * A number that represents the line in the file from where the code snippet was extracted.
     */
    public function startLineNumber(int $startLineNumber): self
    {
        return $this->set('startLineNumber', $startLineNumber);
    }

    public function getType(): string
    {
        return 'CodeBlock';
    }
}
