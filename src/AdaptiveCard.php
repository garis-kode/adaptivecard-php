<?php

declare(strict_types=1);

namespace AdaptiveCards;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Exception\ValidationException;
use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Shared\AdaptiveCardReference;
use AdaptiveCards\Shared\Authentication;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Shared\DocumentReference;
use AdaptiveCards\Shared\Metadata;
use AdaptiveCards\Shared\Refresh;
use AdaptiveCards\Shared\Resources;
use AdaptiveCards\Shared\TeamsCardProperties;
use AdaptiveCards\Support\HasItems;
use AdaptiveCards\Validation\SchemaValidator;

/**
 * An Adaptive Card, containing a free-form body of card elements, and an optional set of actions.
 */
final class AdaptiveCard extends Node
{
    use HasItems;

    public const SCHEMA_URL = 'http://adaptivecards.io/schemas/adaptive-card.json';
    public const DEFAULT_VERSION = '1.6';

    public function __construct(string $version = self::DEFAULT_VERSION)
    {
        $this->version($version);
    }

    public static function make(string $version = self::DEFAULT_VERSION): self
    {
        return new self($version);
    }

    protected function itemsKey(): string
    {
        return 'body';
    }

    public function getType(): string
    {
        return 'AdaptiveCard';
    }

    /**
     * The Adaptive Card schema version the card is authored against.
     * Valid values: "1.0", "1.1", "1.2", "1.3", "1.4", "1.5", "1.6".
     */
    public function version(string $version): self
    {
        return $this->set('version', $version);
    }

    /**
     * The Adaptive Card schema URL.
     */
    public function schema(string $schema): self
    {
        return $this->set('$schema', $schema);
    }

    /**
     * Add a card level action, which always appears at the bottom of the card.
     */
    public function addAction(AbstractAction $action): self
    {
        return $this->push('actions', $action);
    }

    /**
     * Add multiple card level actions.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function addActions(iterable $actions): self
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    /**
     * The card level actions, which always appear at the bottom of the card.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function actions(iterable $actions): self
    {
        return $this->addActions($actions);
    }

    /**
     * An Action that will be invoked when the card is tapped or clicked.
     * Action.ShowCard is not supported.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    /**
     * The text that should be displayed if the client is not able to render the card.
     */
    public function fallbackText(string $text): self
    {
        return $this->set('fallbackText', $text);
    }

    /**
     * Defines the container's background image.
     */
    public function backgroundImage(string|BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    /**
     * The minimum height, in pixels, of the container, in the `<number>px` format.
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    /**
     * A unique identifier for the element or action.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * An alternate element to render if the type of this one is unsupported or
     * if the host application doesn't support all the capabilities specified in
     * the `requires` property.
     */
    public function fallback(mixed $fallback): self
    {
        return $this->set('fallback', $fallback);
    }

    /**
     * A list of capabilities the element requires the host application to support.
     *
     * @param array<string, string> $requires
     */
    public function requires(array $requires): self
    {
        return $this->set('requires', $requires);
    }

    /**
     * The area of a `Layout.AreaGrid` layout in which an element should be displayed.
     */
    public function gridArea(string $gridArea): self
    {
        return $this->set('grid.area', $gridArea);
    }

    /**
     * Controls whether the element should be used as a sort key by elements
     * that allow sorting across a collection of elements.
     */
    public function isSortKey(bool $isSortKey = true): self
    {
        return $this->set('isSortKey', $isSortKey);
    }

    /**
     * Controls how the container's content should be vertically aligned.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', $alignment->value);
    }

    /**
     * The style of the container. Container styles control the colors of the
     * background, border and text inside the container, in such a way that
     * contrast requirements are always met.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function style(ContainerStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls if the content of the card is to be rendered left-to-right or right-to-left.
     */
    public function rtl(bool $rtl = true): self
    {
        return $this->set('rtl', $rtl);
    }

    /**
     * The text that should be spoken for the entire card.
     */
    public function speak(string $speak): self
    {
        return $this->set('speak', $speak);
    }

    /**
     * The locale associated with the element.
     */
    public function lang(string $lang): self
    {
        return $this->set('lang', $lang);
    }

    /**
     * Defines how the card can be refreshed by making a request to the target Bot.
     */
    public function refresh(Refresh $refresh): self
    {
        return $this->set('refresh', $refresh);
    }

    /**
     * Defines authentication information to enable on-behalf-of single-sign-on or just-in-time OAuth.
     */
    public function authentication(Authentication $authentication): self
    {
        return $this->set('authentication', $authentication);
    }

    /**
     * Metadata associated with the card.
     */
    public function metadata(Metadata $metadata): self
    {
        return $this->set('metadata', $metadata);
    }

    /**
     * Teams-specific metadata associated with the card.
     *
     * @param TeamsCardProperties|array<string, mixed> $msteams
     */
    public function msteams(TeamsCardProperties|array $msteams, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $msteams);
        }

        return $this->set('msteams', $msteams);
    }

    /**
     * Resources card elements can reference.
     *
     * @param Resources|array<string, mixed> $resources
     */
    public function resources(Resources|array $resources): self
    {
        return $this->set('resources', $resources);
    }

    /**
     * Add a reference that can be cited in TextBlock and RichTextBlock elements.
     */
    public function addReference(AdaptiveCardReference|DocumentReference $reference): self
    {
        return $this->push('references', $reference);
    }

    /**
     * References that can be cited in TextBlock and RichTextBlock elements.
     *
     * @param iterable<AdaptiveCardReference|DocumentReference> $references
     */
    public function references(iterable $references): self
    {
        foreach ($references as $reference) {
            $this->addReference($reference);
        }

        return $this;
    }

    /**
     * Add a layout associated with the container.
     */
    public function addLayout(AbstractLayout $layout): self
    {
        return $this->push('layouts', $layout);
    }

    /**
     * The layouts associated with the container. The container can dynamically switch
     * from one layout to another as the card's width changes.
     * Valid values: Layout.Stack, Layout.Flow, Layout.AreaGrid.
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): self
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }

        return $this;
    }

    /**
     * Emit the card as an array with `$schema`, `type` and `version` ordered
     * first (as the samples in this repo do).
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $base = parent::toArray(); // ['type' => 'AdaptiveCard', 'version' => ..., ...]

        $ordered = ['$schema' => $base['$schema'] ?? self::SCHEMA_URL, 'type' => $base['type']];
        if (isset($base['version'])) {
            $ordered['version'] = $base['version'];
        }

        foreach ($base as $key => $value) {
            if (!array_key_exists($key, $ordered)) {
                $ordered[$key] = $value;
            }
        }

        return $ordered;
    }

    public function toJson(bool $pretty = true): string
    {
        $flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;
        if ($pretty) {
            $flags |= JSON_PRETTY_PRINT;
        }

        return json_encode($this->toArray(), $flags);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Collect schema-validation errors without throwing.
     *
     * @return list<array{property: string, message: string}>
     */
    public function getValidationErrors(): array
    {
        return (new SchemaValidator())->validate($this->toArray());
    }

    public function isValid(): bool
    {
        return $this->getValidationErrors() === [];
    }

    /**
     * Validate against the bundled 1.6 schema, throwing on any violation.
     *
     * @throws ValidationException
     */
    public function validate(): self
    {
        $errors = $this->getValidationErrors();
        if ($errors !== []) {
            throw new ValidationException($errors);
        }

        return $this;
    }
}
