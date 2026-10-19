<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Action\OpenUrlAction;
use AdaptiveCards\Action\ShowCardAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibilityAction;
use AdaptiveCards\Element\CaptionSource;
use AdaptiveCards\Element\Column;
use AdaptiveCards\Element\Inline\TextRun;
use AdaptiveCards\Element\Media;
use AdaptiveCards\Element\MediaSource;
use AdaptiveCards\Element\RichTextBlock;
use AdaptiveCards\Element\Table;
use AdaptiveCards\Element\TableColumnDefinition;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Shared\Authentication;
use AdaptiveCards\Shared\Metadata;
use AdaptiveCards\Shared\Refresh;
use AdaptiveCards\Enum\ImageStyle;
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

    public function testTableBuildAndValidation(): void
    {
        $card = AdaptiveCard::make()
            ->addTable(fn (Table $t) => $t
                ->columns([TableColumnDefinition::make(1), TableColumnDefinition::make(2)])
                ->addTextRow(['Col 1', 'Col 2'])
            );

        $payload = $card->toArray();
        self::assertSame('Table', $payload['body'][0]['type']);
        self::assertCount(2, $payload['body'][0]['columns']);
        self::assertCount(1, $payload['body'][0]['rows']);
        self::assertTrue($card->isValid());
    }

    public function testMediaBuildAndValidation(): void
    {
        $card = AdaptiveCard::make()
            ->addMedia(fn (Media $m) => $m
                ->poster('https://example.com/poster.png')
                ->addSource(MediaSource::make('https://example.com/video.mp4', 'video/mp4'))
                ->addCaptionSource(CaptionSource::make('https://example.com/captions.vtt', 'vtt', 'English'))
            );

        $payload = $card->toArray();
        self::assertSame('Media', $payload['body'][0]['type']);
        self::assertSame('https://example.com/poster.png', $payload['body'][0]['poster']);
        self::assertCount(1, $payload['body'][0]['sources']);
        self::assertCount(1, $payload['body'][0]['captionSources']);
        self::assertTrue($card->isValid());
    }

    public function testRichTextBlockBuildAndValidation(): void
    {
        $card = AdaptiveCard::make()
            ->addRichTextBlock(fn (RichTextBlock $r) => $r
                ->addTextRun('Hello ', fn (TextRun $tr) => $tr->weight('bolder')->color('accent'))
                ->addInline('world!')
            );

        $payload = $card->toArray();
        self::assertSame('RichTextBlock', $payload['body'][0]['type']);
        self::assertCount(2, $payload['body'][0]['inlines']);
        self::assertSame('TextRun', $payload['body'][0]['inlines'][0]['type']);
        self::assertSame('world!', $payload['body'][0]['inlines'][1]);
        self::assertTrue($card->isValid());
    }

    public function testShowCardActionBuildAndValidation(): void
    {
        $innerCard = AdaptiveCard::make()->addTextBlock('Inner');
        $card = AdaptiveCard::make()->addAction(ShowCardAction::make('More', $innerCard));

        $payload = $card->toArray();
        self::assertSame('Action.ShowCard', $payload['actions'][0]['type']);
        self::assertSame('AdaptiveCard', $payload['actions'][0]['card']['type']);
        self::assertTrue($card->isValid());
    }

    public function testSharedStructuresBuildAndValidation(): void
    {
        $card = AdaptiveCard::make()
            ->metadata(Metadata::make('https://adaptivecards.io'))
            ->refresh(Refresh::make()->action(ExecuteAction::make('Refresh', 'refreshVerb')))
            ->authentication(Authentication::make()->connectionName('botConnection'));

        $payload = $card->toArray();
        self::assertSame('https://adaptivecards.io', $payload['metadata']['webUrl']);
        self::assertSame('refreshVerb', $payload['refresh']['action']['verb']);
        self::assertSame('botConnection', $payload['authentication']['connectionName']);
        self::assertTrue($card->isValid());
    }

    public function testActivityUpdateScenarioIsValid(): void
    {
        $card = AdaptiveCard::make()
            ->addTextBlock('Publish Adaptive Card schema', fn ($t) => $t
                ->weight('bolder')->size('medium')->wrap(true)->style('heading'))
            ->addColumnSet(fn ($cs) => $cs
                ->column('auto', fn (Column $c) => $c
                    ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
                        ->size('small')->style(ImageStyle::Person)->altText('Matt Hidinger')))
                ->column('stretch', fn (Column $c) => $c
                    ->addTextBlock('Matt Hidinger', fn ($t) => $t->weight('bolder')->wrap(true))
                    ->addTextBlock('Created today', fn ($t) => $t->isSubtle(true)->spacing('none')->wrap(true))))
            ->addFactSet([
                'Board:' => 'Adaptive Cards',
                'List:' => 'Backlog',
                'Assigned to:' => 'Matt Hidinger',
            ])
            ->addAction(OpenUrlAction::make('View', 'https://adaptivecards.io'));

        self::assertSame([], $card->getValidationErrors());
        self::assertTrue($card->isValid());
    }
}
