<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

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
     * Column definitions for the area grid layout.
     *
     * @param list<string|array{width: string}> $columns
     */
    public function columns(array $columns): self
    {
        return $this->set('columns', $columns);
    }

    /**
     * Grid area definitions mapping named areas to rows and columns.
     *
     * @param list<array{name: string, row?: int, column?: int, rowSpan?: int, columnSpan?: int}> $areas
     */
    public function areas(array $areas): self
    {
        return $this->set('areas', $areas);
    }

    public function getType(): string
    {
        return 'Layout.AreaGrid';
    }
}
