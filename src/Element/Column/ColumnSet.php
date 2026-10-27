<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Column;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\Width;

/**
 * Splits the available horizontal space into separate columns, so elements can be organized in a row.
 */
final class ColumnSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a column to the column set.
     */
    public function addColumn(Column $column): self
    {
        return $this->push('columns', $column);
    }

    /**
     * Add multiple columns to the column set.
     *
     * @param iterable<Column> $columns
     */
    public function addColumns(iterable $columns): self
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        return $this;
    }

    /**
     * The columns in this column set.
     *
     * @param iterable<Column> $columns
     */
    public function columns(iterable $columns): self
    {
        return $this->addColumns($columns);
    }

    /**
     * Create, configure and append a column in one call.
     *
     * @param Width|int|null $width Width::Auto, Width::Stretch, or a weight number.
     */
    public function column(Width|int|null $width = null, ?callable $configure = null): self
    {
        $column = new Column();
        if ($width !== null) {
            $column->width($width);
        }
        if ($configure !== null) {
            $configure($column);
        }

        return $this->addColumn($column);
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
     * Determines whether the element should bleed through its parent's padding.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    /**
     * The minimum height, in pixels, of the container.
     */
    public function minHeight(int $minHeight): self
    {
        return $this->set('minHeight', "{$minHeight}px");
    }

    /**
     * The minimum width, in pixels, of the column set, or Width::Auto.
     */
    public function minWidth(Width|int $minWidth): self
    {
        $value = $minWidth instanceof Width ? $minWidth->value : "{$minWidth}px";

        return $this->set('minWidth', $value);
    }

    /**
     * Controls whether corners should be rounded.
     */
    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    /**
     * Controls whether border should be displayed.
     */
    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    /**
     * An Action that will be invoked when the ColumnSet is tapped or clicked.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'ColumnSet';
    }
}
