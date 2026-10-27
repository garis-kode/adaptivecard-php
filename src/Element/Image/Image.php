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
     * The alternate text for the image, used for accessibility purposes.
     */
    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    /**
     * The size of the image.
     * Valid values: "Auto", "Stretch", "Small", "Medium", "Large".
     */
    public function size(ImageSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The style of the image.
     * Valid values: "Default", "Person", "RoundedCorners".
     */
    public function style(ImageStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * The background color of the image in the `#RRGGBB` or `#AARRGGBB` format.
     */
    public function backgroundColor(string $color): self
    {
        return $this->set('backgroundColor', $color);
    }

    /**
     * The width of the image.
     * Valid values: "auto", "stretch", "<number>px".
     */
    public function width(Width|string $width): self
    {
        $value = $width instanceof Width ? $width->value : $width;

        return $this->set('width', $value);
    }

    /**
     * The height of the image.
     * Valid values: "auto", "stretch", "<number>px".
     */
    public function height(Height|string $height): static
    {
        $value = $height instanceof Height ? $height->value : $height;

        return $this->set('height', $value);
    }

    /**
     * Controls if the image can be expanded to full screen.
     */
    public function allowExpand(bool $allow = true): self
    {
        return $this->set('allowExpand', $allow);
    }

    /**
     * Controls how the image should be fitted inside its bounding box. `imageFit` is
     * only meaningful when both the width and height properties are set. When `fitMode`
     * is set to `contain`, the default style is always used.
     * Valid values: "Cover", "Contain", "Fill".
     */
    public function fitMode(ImageFitMode $fitMode): self
    {
        return $this->set('fitMode', $fitMode->value);
    }

    /**
     * Controls the horizontal position of the image within its bounding box.
     * `horizontalContentAlignment` is only meaningful when both the width and height
     * properties are set and `fitMode` is set to either `cover` or `contain`.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalContentAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalContentAlignment', $alignment->value);
    }

    /**
     * Controls the vertical position of the image within its bounding box.
     * `verticalContentAlignment` is only meaningful when both the width and height
     * properties are set and `fitMode` is set to either `cover` or `contain`.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', $alignment->value);
    }

    /**
     * A set of theme-specific image URLs.
     * Valid values: ThemedUrl.
     *
     * @param list<array<string, mixed>> $themedUrls
     */
    public function themedUrls(array $themedUrls): self
    {
        return $this->set('themedUrls', $themedUrls);
    }

    /**
     * Teams-specific metadata associated with the image.
     * Valid values: TeamsImageProperties.
     */
    public function msteams(TeamsImageProperties $properties, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $properties);
        }

        return $this->set('msteams', $properties);
    }

    /**
     * An Action that will be invoked when the image is tapped or clicked.
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
