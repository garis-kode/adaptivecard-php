<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Table;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * Displays tabular data in rows and columns (schema 1.5+).
 */
final class Table extends AbstractElement
{
    /**
     * @param iterable<TableColumnDefinition|string|int>|null $columns
     * @param iterable<TableRow|iterable<TableCell>>|null $rows
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
     * @param iterable<TableColumnDefinition|string|int>|null $columns
     * @param iterable<TableRow|iterable<TableCell>>|null $rows
     */
    public static function make(
        ?iterable $columns = null,
        ?iterable $rows = null,
    ): self {
        return new self($columns, $rows);
    }

    /**
     * Define columns. Integers/strings become column widths; pass
     * TableColumnDefinition objects for full control.
     *
     * @param iterable<TableColumnDefinition|string|int> $columns
     */
    public function columns(iterable $columns): self
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        return $this;
    }

    public function addColumn(TableColumnDefinition|string|int $column): self
    {
        return $this->push(
            'columns',
            $column instanceof TableColumnDefinition ? $column : new TableColumnDefinition($column)
        );
    }

    /**
     * @param iterable<TableRow|iterable<TableCell>> $rows
     */
    public function rows(iterable $rows): self
    {
        foreach ($rows as $row) {
            if ($row instanceof TableRow) {
                $this->addRow($row);
            } elseif (is_iterable($row)) {
                $tableRow = new TableRow();
                $tableRow->cells($row);
                $this->addRow($tableRow);
            }
        }

        return $this;
    }

    public function addRow(TableRow $row): self
    {
        return $this->push('rows', $row);
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
            $row->addTextCell($text, static fn ($tb) => $tb->wrap(true));
        }

        return $this->addRow($row);
    }

    public function showGridLines(bool $value = true): self
    {
        return $this->set('showGridLines', $value);
    }

    public function firstRowAsHeaders(bool $value = true): self
    {
        return $this->set('firstRowAsHeaders', $value);
    }

    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    public function minWidth(string $width): self
    {
        return $this->set('minWidth', $width);
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function gridStyle(string|ContainerStyle $style): self
    {
        return $this->set('gridStyle', ContainerStyle::value($style));
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
        return 'Table';
    }
}
