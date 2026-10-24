<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconStyle;

/**
 * An inline icon inside a RichTextBlock element.
 */
final class IconRun extends AbstractElement
{
    public function __construct(string $name)
    {
        $this->set('name', $name);
    }

    public static function make(string $name): self
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

    /**
     * @param "Small"|"Default"|"Medium"|"Large"|"ExtraLarge"|string $size
     */
    public function size(string $size): self
    {
        return $this->set('size', $size);
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
        return 'IconRun';
    }
}
