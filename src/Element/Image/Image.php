<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\VerticalAlignment;

/**
 * Displays an image.
 */
final class Image extends AbstractElement
{
    public function __construct()
    {
    }

    public static function make(): self
    {
        return new self();
    }

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    public function size(string|ImageSize $size): self
    {
        return $this->set('size', ImageSize::value($size));
    }

    public function style(string|ImageStyle $style): self
    {
        return $this->set('style', ImageStyle::value($style));
    }

    public function backgroundColor(string $color): self
    {
        return $this->set('backgroundColor', $color);
    }

    /**
     * Explicit width, e.g. "50px".
     */
    public function width(string $width): self
    {
        return $this->set('width', $width);
    }

    /**
     * Explicit height, e.g. "50px" (overrides the element height enum).
     */
    public function pixelHeight(string $height): self
    {
        return $this->set('height', $height);
    }

    public function allowExpand(bool $allow = true): self
    {
        return $this->set('allowExpand', $allow);
    }

    /**
     * @param "Cover"|"Contain"|"Fill"|string $fitMode
     */
    public function fitMode(string $fitMode): self
    {
        return $this->set('fitMode', $fitMode);
    }

    public function horizontalContentAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalContentAlignment', HorizontalAlignment::value($alignment));
    }

    public function verticalContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', VerticalAlignment::value($alignment));
    }

    /**
     * @param list<array<string, mixed>> $themedUrls
     */
    public function themedUrls(array $themedUrls): self
    {
        return $this->set('themedUrls', $themedUrls);
    }

    /**
     * @param TeamsImageProperties|array<string, mixed> $properties
     */
    public function msteams(TeamsImageProperties|array $properties, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $properties);
        }

        return $this->set('msteams', $properties);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Image';
    }
}
