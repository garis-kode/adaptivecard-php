<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Column;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * Splits the available horizontal space into separate columns, so elements can be organized in a row.
 */
final class ColumnSet extends AbstractBlockElement
{
    use HasHorizontalAlignment, HasSpacing;

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
     * The columns in the set.
     * Valid values: "Column".
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
     * @param Width|string|int|null $width Width::Auto, Width::Stretch, explicit pixel width (e.g. '25px'), or a weight number.
     */
    public function column(Width|string|int|null $width = null, ?callable $configure = null): self
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
     * Controls if the container should bleed into its parent. A bleeding container extends into its parent's padding.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    /**
     * The minimum height, in pixels, of the container, in the `<number>px` format.
     * Valid values: "<number>px".
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    /**
     * The minimum width of the column set. `auto` will automatically adjust the column set's
     * minimum width according to its content and using the `<number>px` format will give the
     * column set an explicit minimum width in pixels. A scrollbar will be displayed if the
     * available width is less than the specified minimum width.
     * Valid values: "auto", "<number>px".
     */
    public function minWidth(Width|string $minWidth): self
    {
        $value = $minWidth instanceof Width ? $minWidth->value : $minWidth;

        return $this->set('minWidth', $value);
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
     * An Action that will be invoked when the element is tapped or clicked.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
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
