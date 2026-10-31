<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Support\HasHorizontalAlignment;

/**
 * Represents a row of cells in a table.
 */
final class TableRow extends AbstractElement
{
    use HasHorizontalAlignment;

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
     * The cells in the row.
     * Valid values: "TableCell".
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
     * The style of the container. Container styles control the colors of the background,
     * border and text inside the container, in such a way that contrast requirements are always met.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function style(ContainerStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls if the container should have rounded corners.
     */
    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    /**
     * Controls if a border should be displayed around the container.
     */
    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    /**
     * Controls how the content of every cell in the row should be horizontally aligned by default.
     * This property overrides the `horizontalCellContentAlignment` property of the table and columns.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how the content of every cell in the row should be vertically aligned by default.
     * This property overrides the `verticalCellContentAlignment` property of the table and columns.
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
