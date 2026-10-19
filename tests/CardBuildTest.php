<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibilityAction;
use AdaptiveCards\Element\Column;
use AdaptiveCards\Element\TextBlock;
use PHPUnit\Framework\TestCase;

final class CardBuildTest extends TestCase
{
    public function testRootCarriesSchemaTypeAndVersion(): void
    {
        $card = AdaptiveCard::make()->toArray();

        self::assertSame('http://adaptivecards.io/schemas/adaptive-card.json', $card['$schema']);
        self::assertSame('AdaptiveCard', $card['type']);
        self::assertSame('1.6', $card['version']);
    }

    public function testFluentBuildProducesExpectedStructure(): void
    {
        $card = AdaptiveCard::make()
            ->addTextBlock('Hello', fn (TextBlock $t) => $t->size('large')->weight('bolder')->wrap(true))
            ->addFactSet(['A' => '1', 'B' => '2'])
            ->addAction(OpenUrlAction::make('Go', 'https://example.com'))
            ->addAction(SubmitAction::make('Send')->data(['x' => 1]));

        $expected = [
            '$schema' => 'http://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.6',
            'body' => [
                ['type' => 'TextBlock', 'text' => 'Hello', 'size' => 'large', 'weight' => 'bolder', 'wrap' => true],
                ['type' => 'FactSet', 'facts' => [
                    ['title' => 'A', 'value' => '1'],
                    ['title' => 'B', 'value' => '2'],
                ]],
            ],
            'actions' => [
                ['type' => 'Action.OpenUrl', 'title' => 'Go', 'url' => 'https://example.com'],
                ['type' => 'Action.Submit', 'title' => 'Send', 'data' => ['x' => 1]],
            ],
        ];

        self::assertSame($expected, $card->toArray());
    }

    public function testNullAndDefaultPropertiesAreOmitted(): void
    {
        $block = TextBlock::make('hi')->toArray();

        self::assertSame(['type' => 'TextBlock', 'text' => 'hi'], $block);
    }

    public function testColumnSetNesting(): void
    {
        $card = AdaptiveCard::make()->addColumnSet(fn ($cs) => $cs
            ->column('auto', fn (Column $c) => $c->addTextBlock('left'))
            ->column('stretch', fn (Column $c) => $c->addTextBlock('right')));

        $columns = $card->toArray()['body'][0]['columns'];

        self::assertCount(2, $columns);
        self::assertSame('auto', $columns[0]['width']);
        self::assertSame('Column', $columns[0]['type']);
        self::assertSame('left', $columns[0]['items'][0]['text']);
    }

    public function testToggleVisibilityEmitsCompactAndObjectTargets(): void
    {
        $action = ToggleVisibilityAction::make('Toggle')
            ->target('alpha')
            ->target('beta', false);

        self::assertSame(
            ['alpha', ['elementId' => 'beta', 'isVisible' => false]],
            $action->toArray()['targetElements']
        );
    }

    public function testToJsonIsValidJsonAndStringable(): void
    {
        $card = AdaptiveCard::make()->addTextBlock('hi');

        self::assertSame($card->toArray(), json_decode($card->toJson(), true));
        self::assertSame($card->toJson(), (string) $card);
    }
}
