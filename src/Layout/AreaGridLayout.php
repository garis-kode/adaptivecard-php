<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

use AdaptiveCards\Enum\Spacing;

/**
 * Area grid layout: positions elements in named grid areas.
 */
final class AreaGridLayout extends AbstractLayout
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a column definition to the area grid layout. Columns can be defined
     * as a percentage of the available width (number) or in pixels ("<number>px").
     */
    public function addColumn(int|float|string $column): self
    {
        return $this->push('columns', $column);
    }

    /**
     * The columns in the grid layout, defined as a percentage of the available
     * width or in pixels using the `<number>px` format.
     *
     * @param iterable<int|float|string> $columns
     */
    public function columns(iterable $columns): self
    {
        $items = [];
        foreach ($columns as $column) {
            $items[] = $column;
        }

        return $this->set('columns', $items);
    }

    /**
     * Add an area definition to the grid layout.
     */
    public function addArea(GridArea $area): self
    {
        return $this->push('areas', $area);
    }

    /**
     * Add multiple area definitions to the grid layout.
     *
     * @param iterable<GridArea> $areas
     */
    public function addAreas(iterable $areas): self
    {
        foreach ($areas as $area) {
            $this->addArea($area);
        }

        return $this;
    }

    /**
     * The areas in the grid layout mapping named areas to rows and columns.
     * Valid values: "GridArea".
     *
     * @param iterable<GridArea> $areas
     */
    public function areas(iterable $areas): self
    {
        return $this->addAreas($areas);
    }

    /**
     * The space between columns.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function columnSpacing(Spacing $spacing): self
    {
        return $this->set('columnSpacing', $spacing->value);
    }

    /**
     * The space between rows.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function rowSpacing(Spacing $spacing): self
    {
        return $this->set('rowSpacing', $spacing->value);
    }

    public function getType(): string
    {
        return 'Layout.AreaGrid';
    }
}
