<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;

/**
 * Use tables to display data in a tabular way, with rows, columns and cells.
 */
final class Table extends AbstractBlockElement
{
    /**
     * @param iterable<TableColumnDefinition>|null $columns
     * @param iterable<TableRow>|null $rows
     */
    public function __construct(
        ?iterable $columns = null,
        ?iterable $rows = null,
    ) {
        if ($columns !== null) {
            $this->columns($columns);
        }
        if ($rows !== null) {
            $this->rows($rows);
        }
    }

    /**
     * @param iterable<TableColumnDefinition>|null $columns
     * @param iterable<TableRow>|null $rows
     */
    public static function make(
        ?iterable $columns = null,
        ?iterable $rows = null,
    ): self {
        return new self($columns, $rows);
    }

    /**
     * Add a column to the table.
     */
    public function addColumn(TableColumnDefinition $column): self
    {
        return $this->push('columns', $column);
    }

    /**
     * Add multiple columns to the table.
     *
     * @param iterable<TableColumnDefinition> $columns
     */
    public function addColumns(iterable $columns): self
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        return $this;
    }

    /**
     * The columns in the table.
     * Valid values: "ColumnDefinition".
     *
     * @param iterable<TableColumnDefinition> $columns
     */
    public function columns(iterable $columns): self
    {
        return $this->addColumns($columns);
    }

    /**
     * Add a row to the table.
     */
    public function addRow(TableRow $row): self
    {
        return $this->push('rows', $row);
    }

    /**
     * Add multiple rows to the table.
     *
     * @param iterable<TableRow> $rows
     */
    public function addRows(iterable $rows): self
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    /**
     * The rows of the table.
     * Valid values: "TableRow".
     *
     * @param iterable<TableRow> $rows
     */
    public function rows(iterable $rows): self
    {
        return $this->addRows($rows);
    }

    /**
     * Convenience: add a row of plain-text cells.
     *
     * @param list<string> $cells
     */
    public function addTextRow(array $cells): self
    {
        $row = new TableRow();
        foreach ($cells as $text) {
            $row->addTextCell($text, static fn (TextBlock $tb) => $tb->wrap(true));
        }

        return $this->addRow($row);
    }

    /**
     * Controls if grid lines should be displayed.
     */
    public function showGridLines(bool $value = true): self
    {
        return $this->set('showGridLines', $value);
    }

    /**
     * Controls whether the first row of the table should be treated as a header.
     */
    public function firstRowAsHeaders(bool $value = true): self
    {
        return $this->set('firstRowAsHeaders', $value);
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
     * The minimum width of the table in pixels. `auto` will automatically adjust the
     * table's minimum width according to its content and using the `<number>px` format will
     * give the table an explicit minimum width in pixels. A scrollbar will be displayed if
     * the available width is less than the specified minimum width.
     * Valid values: "auto", "<number>px".
     */
    public function minWidth(Width|string $width): self
    {
        $value = $width instanceof Width ? $width->value : $width;

        return $this->set('minWidth', $value);
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
     * The style of the grid lines between cells.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function gridStyle(ContainerStyle $style): self
    {
        return $this->set('gridStyle', $style->value);
    }

    /**
     * Controls how the content of every cell in the table should be horizontally aligned by default.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how the content of every cell in the table should be vertically aligned by default.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalCellContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalCellContentAlignment', $alignment->value);
    }

    public function getType(): string
    {
        return 'Table';
    }
}
