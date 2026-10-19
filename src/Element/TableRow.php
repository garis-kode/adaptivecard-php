<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * A row of {@see TableCell}s within a {@see Table}.
 */
final class TableRow extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    public function addCell(TableCell $cell): self
    {
        return $this->push('cells', $cell);
    }

    /**
     * Convenience: add a cell containing a single TextBlock.
     */
    public function addTextCell(string $text, ?callable $configure = null): self
    {
        $cell = new TableCell();
        $cell->addTextBlock($text, $configure);

        return $this->addCell($cell);
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function horizontalCellContentAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', HorizontalAlignment::value($alignment));
    }

    public function verticalCellContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalCellContentAlignment', VerticalAlignment::value($alignment));
    }

    public function getType(): string
    {
        return 'TableRow';
    }
}
