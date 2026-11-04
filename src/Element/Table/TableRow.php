<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSeparator;
use AdaptiveCards\Support\HasSpacing;

/**
 * Represents a row of cells in a table.
 */
final class TableRow extends AbstractElement
{
    use HasHeight;
    use HasHorizontalAlignment;
    use HasSeparator;
    use HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a cell to the row.
     *
     * @param TableCell|iterable<TableCell> $cell
     */
    public function addCells(TableCell|iterable $cell): self
    {
        if (is_iterable($cell)) {
            foreach ($cell as $item) {
                $this->push('cells', $item);
            }

            return $this;
        }

        return $this->push('cells', $cell);
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

        return $this->addCells($cell);
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
