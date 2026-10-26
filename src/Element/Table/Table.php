<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * Use tables to display data in a tabular way, with rows, columns and cells.
 */
final class Table extends AbstractElement
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
     * Defines the table's columns (their widths and default content alignment).
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
     * Defines the table's rows.
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
     * Controls whether grid lines should be displayed between cells in the table.
     */
    public function showGridLines(bool $value = true): self
    {
        return $this->set('showGridLines', $value);
    }

    /**
     * Defines whether the first row of the table should be treated as a header row,
     * and be repeated on every page of a printout.
     */
    public function firstRowAsHeaders(bool $value = true): self
    {
        return $this->set('firstRowAsHeaders', $value);
    }

    /**
     * Controls whether the table's corners should be rounded.
     */
    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    /**
     * Controls whether the table's border should be displayed.
     */
    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    /**
     * The minimum width, in pixels, of the table.
     */
    public function minWidth(string $width): self
    {
        return $this->set('minWidth', $width);
    }

    /**
     * The style of the table.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function style(ContainerStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls the style of grid lines displayed between cells in the table.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function gridStyle(ContainerStyle $style): self
    {
        return $this->set('gridStyle', $style->value);
    }

    /**
     * Controls how cells should be horizontally aligned by default across the entire table.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalCellContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalCellContentAlignment', $alignment->value);
    }

    /**
     * Controls how cells should be vertically aligned by default across the entire table.
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
