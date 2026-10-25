<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * Represents a row of cells in a table.
 */
final class TableRow extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a cell to the row.
     */
    public function addCell(TableCell $cell): self
    {
        return $this->push('cells', $cell);
    }

    /**
     * Add multiple cells to the row.
     *
     * @param iterable<TableCell> $cells
     */
    public function addCells(iterable $cells): self
    {
        foreach ($cells as $cell) {
            $this->addCell($cell);
        }

        return $this;
    }

    /**
     * The cells in this row.
     *
     * @param iterable<TableCell> $cells
     */
    public function cells(iterable $cells): self
    {
        return $this->addCells($cells);
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

    /**
     * The style of the table row.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function style(ContainerStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls whether the row's corners should be rounded.
     */
    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    /**
     * Controls whether the row's border should be displayed.
     */
    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    /**
     * Controls how cells should be horizontally aligned in this row.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how cells should be vertically aligned in this row.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalCellContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalCellContentAlignment', $alignment->value);
    }

    public function getType(): string
    {
        return 'TableRow';
    }
}
