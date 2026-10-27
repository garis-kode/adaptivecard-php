<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageFitMode;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;

/**
 * A standalone image element.
 */
final class Image extends AbstractElement
{
    public function __construct(?string $url = null)
    {
        if ($url !== null) {
            $this->url($url);
        }
    }

    public static function make(?string $url = null): self
    {
        return new self($url);
    }

    /**
     * The URL (or Base64-encoded Data URI) of the image. Acceptable formats are PNG, JPEG, GIF and SVG.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The alternative text that describes the image.
     */
    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    /**
     * Controls the approximate size of the image.
     * Valid values: "Auto", "Stretch", "Small", "Medium", "Large".
     */
    public function size(ImageSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * Controls how this element is displayed.
     * Valid values: "Default", "Person", "RoundedCorners".
     */
    public function style(ImageStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Applies a background to a transparent image.
     */
    public function backgroundColor(string $color): self
    {
        return $this->set('backgroundColor', $color);
    }

    /**
     * The width of the image.
     * Valid values: "auto", "stretch", pixel count.
     */
    public function width(Width|int $width): self
    {
        $value = $width instanceof Width ? $width->value : "{$width}px";

        return $this->set('width', $value);
    }

    /**
     * The height of the image.
     * Valid values: "auto", "stretch", pixel count.
     */
    public function height(Height|int $height): static
    {
        $value = $height instanceof Height ? $height->value : "{$height}px";

        return $this->set('height', $value);
    }

    /**
     * Controls whether the image can be expanded by the user.
     */
    public function allowExpand(bool $allow = true): self
    {
        return $this->set('allowExpand', $allow);
    }

    /**
     * Controls how the image should fill its container.
     * Valid values: "Cover", "Contain", "Fill".
     */
    public function fitMode(ImageFitMode $fitMode): self
    {
        return $this->set('fitMode', $fitMode->value);
    }

    /**
     * Controls horizontal content alignment.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalContentAlignment', $alignment->value);
    }

    /**
     * Controls vertical content alignment.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', $alignment->value);
    }

    /**
     * Controls alternative image URLs based on the active theme.
     *
     * @param list<array<string, mixed>> $themedUrls
     */
    public function themedUrls(array $themedUrls): self
    {
        return $this->set('themedUrls', $themedUrls);
    }

    /**
     * Represents a set of Teams-specific properties on an image.
     */
    public function msteams(TeamsImageProperties $properties, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $properties);
        }

        return $this->set('msteams', $properties);
    }

    /**
     * An Action that will be invoked when the element is tapped or clicked.
     * Action.ShowCard is not supported.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Image';
    }
}
