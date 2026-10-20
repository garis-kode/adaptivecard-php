<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * Displays tabular data in rows and columns (schema 1.5+).
 */
final class Table extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Define columns. Integers/strings become column widths; pass
     * TableColumnDefinition objects for full control.
     *
     * @param list<TableColumnDefinition|string|int> $columns
     */
    public function columns(array $columns): self
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
