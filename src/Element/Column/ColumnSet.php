<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Column;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;

/**
 * Divides a region into {@see Column}s, allowing side-by-side layout.
 */
final class ColumnSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    public function addColumn(Column $column): self
    {
        return $this->push('columns', $column);
    }

    /**
     * Create, configure and append a column in one call.
     *
     * @param string|int|null $width "auto", "stretch", a weight or pixels.
     */
    public function column(string|int|null $width = null, ?callable $configure = null): self
    {
        $column = new Column($width);
        if ($configure !== null) {
            $configure($column);
        }

        return $this->addColumn($column);
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function minWidth(string $minWidth): self
    {
        return $this->set('minWidth', $minWidth);
    }

    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'ColumnSet';
    }
}
