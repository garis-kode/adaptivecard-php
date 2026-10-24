<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;

/**
 * A standalone icon element picked from the Adaptive Card icon catalog.
 */
final class Icon extends AbstractElement
{
    public function __construct(?string $name = null)
    {
        $this->set('name', $name);
    }

    public static function make(?string $name = null): self
    {
        return new self($name);
    }

    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    public function color(string|Colors $color): self
    {
        return $this->set('color', Colors::value($color));
    }

    public function size(string|IconSize $size): self
    {
        return $this->set('size', IconSize::value($size));
    }

    public function style(string|IconStyle $style): self
    {
        return $this->set('style', IconStyle::value($style));
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Icon';
    }
}
