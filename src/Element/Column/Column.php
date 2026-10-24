<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Column;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Support\HasItems;

/**
 * A single column within a {@see ColumnSet}.
 */
final class Column extends AbstractElement
{
    use HasItems;

    /**
     * @param string|int|null $width "auto", "stretch", a weight (e.g. 2) or pixels ("50px").
     */
    public function __construct(string|int|null $width = null)
    {
        if ($width !== null) {
            $this->set('width', $width);
        }
    }

    public static function make(string|int|null $width = null): self
    {
        return new self($width);
    }

    public function width(string|int $width): self
    {
        return $this->set('width', $width);
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function verticalContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', VerticalAlignment::value($alignment));
    }

    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function maxHeight(string $maxHeight): self
    {
        return $this->set('maxHeight', $maxHeight);
    }

    public function roundedCorners(bool $value = true): self
    {
        return $this->set('roundedCorners', $value);
    }

    public function showBorder(bool $value = true): self
    {
        return $this->set('showBorder', $value);
    }

    public function addLayout(AbstractLayout $layout): self
    {
        return $this->push('layouts', $layout);
    }

    /**
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): self
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }

        return $this;
    }

    public function rtl(bool $rtl = true): self
    {
        return $this->set('rtl', $rtl);
    }

    public function backgroundImage(string|BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Column';
    }
}
