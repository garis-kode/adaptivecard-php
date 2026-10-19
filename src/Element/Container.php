<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Support\HasItems;

/**
 * Groups a collection of elements together.
 */
final class Container extends AbstractElement
{
    use HasItems;

    public static function make(): self
    {
        return new self();
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
        return 'Container';
    }
}
