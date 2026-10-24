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
 * Root of an Adaptive Card and the fluent entry point for building one.
 *
 * Example:
 *   $json = AdaptiveCard::make()
 *       ->addTextBlock('Hello', fn ($t) => $t->size('large')->weight('bolder'))
 *       ->addAction(OpenUrlAction::make('Docs', 'https://adaptivecards.io'))
 *       ->validate()
 *       ->toJson();
 */
final class AdaptiveCard extends Node
{
    use HasItems;

    public const SCHEMA_URL = 'http://adaptivecards.io/schemas/adaptive-card.json';
    public const DEFAULT_VERSION = '1.6';

    public function __construct(string $version = self::DEFAULT_VERSION)
    {
        $this->set('version', $version);
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

    public function version(string $version): self
    {
        return $this->set('version', $version);
    }

    public function addAction(AbstractAction $action): self
    {
        return $this->push('actions', $action);
    }

    /**
     * @param iterable<AbstractAction> $actions
     */
    public function addActions(iterable $actions): self
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function fallbackText(string $text): self
    {
        return $this->set('fallbackText', $text);
    }

    public function backgroundImage(string|BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function verticalContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', VerticalAlignment::value($alignment));
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function rtl(bool $rtl = true): self
    {
        return $this->set('rtl', $rtl);
    }

    public function speak(string $speak): self
    {
        return $this->set('speak', $speak);
    }

    public function lang(string $lang): self
    {
        return $this->set('lang', $lang);
    }

    public function refresh(Refresh $refresh): self
    {
        return $this->set('refresh', $refresh);
    }

    public function authentication(Authentication $authentication): self
    {
        return $this->set('authentication', $authentication);
    }

    public function metadata(Metadata $metadata): self
    {
        return $this->set('metadata', $metadata);
    }

    /**
     * @param TeamsCardProperties|array<string, mixed> $msteams
     */
    public function msteams(TeamsCardProperties|array $msteams): self
    {
        return $this->set('msteams', $msteams);
    }

    /**
     * @param Resources|array<string, mixed> $resources
     */
    public function resources(Resources|array $resources): self
    {
        return $this->set('resources', $resources);
    }

    public function addReference(AdaptiveCardReference|DocumentReference $reference): self
    {
        return $this->push('references', $reference);
    }

    /**
     * @param iterable<AdaptiveCardReference|DocumentReference> $references
     */
    public function references(iterable $references): self
    {
        foreach ($references as $reference) {
            $this->addReference($reference);
        }

        return $this;
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

    /**
     * Emit the card as an array with `$schema`, `type` and `version` ordered
     * first (as the samples in this repo do).
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $base = parent::toArray(); // ['type' => 'AdaptiveCard', 'version' => ..., ...]

        $ordered = ['$schema' => self::SCHEMA_URL, 'type' => $base['type']];
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
