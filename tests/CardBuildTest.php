<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Chart\DonutChart;
use AdaptiveCards\Chart\Gauge\GaugeChart;
use AdaptiveCards\Chart\HorizontalBar\HorizontalBarChart;
use AdaptiveCards\Chart\HorizontalBar\StackedHorizontalBarChart;
use AdaptiveCards\Chart\LineChart;
use AdaptiveCards\Chart\PieChart;
use AdaptiveCards\Chart\VerticalBar\GroupedVerticalBarChart;
use AdaptiveCards\Chart\VerticalBar\VerticalBarChart;
use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Action\InsertImageAction;
use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\OpenUrl\OpenUrlDialogAction;
use AdaptiveCards\Action\PopoverAction;
use AdaptiveCards\Action\ResetInputsAction;
use AdaptiveCards\Action\ShowCardAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\Element\Badge;
use AdaptiveCards\Element\CodeBlock;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\CompoundButton;
use AdaptiveCards\Element\Fact\Fact;
use AdaptiveCards\Element\Fact\FactSet;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\Progress\ProgressBar;
use AdaptiveCards\Element\Progress\ProgressRing;
use AdaptiveCards\Element\Rating;
use AdaptiveCards\Element\Media\CaptionSource;
use AdaptiveCards\Element\Media\Media;
use AdaptiveCards\Element\Media\MediaSource;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\Table\Table;
use AdaptiveCards\Element\Table\TableCell;
use AdaptiveCards\Element\Table\TableColumnDefinition;
use AdaptiveCards\Element\Table\TableRow;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
use AdaptiveCards\Input\RatingInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\TimeInput;
use AdaptiveCards\Input\ToggleInput;
use AdaptiveCards\Shared\Authentication;
use AdaptiveCards\Shared\Metadata;
use AdaptiveCards\Shared\Refresh;
use AdaptiveCards\Enum\BadgeSize;
use AdaptiveCards\Enum\BadgeStyle;
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

    public function testColumnConstructorTakesNoArguments(): void
    {
        $column = new Column();
        self::assertSame(['type' => 'Column'], $column->toArray());

        $columnWithWidth = (new Column())->width('auto');
        self::assertSame(['type' => 'Column', 'width' => 'auto'], $columnWithWidth->toArray());

        $fromMake = Column::make();
        self::assertSame(['type' => 'Column'], $fromMake->toArray());
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
                ->addSource(MediaSource::make()->url('https://example.com/video.mp4')->mimeType('video/mp4'))
                ->addCaptionSource(CaptionSource::make('https://example.com/captions.vtt', 'vtt', 'English'))
            );

        $payload = $card->toArray();
        self::assertSame('Media', $payload['body'][0]['type']);
        self::assertSame('https://example.com/poster.png', $payload['body'][0]['poster']);
        self::assertCount(1, $payload['body'][0]['sources']);
        self::assertCount(1, $payload['body'][0]['captionSources']);
        self::assertTrue($card->isValid());
    }

    public function testMediaSourceConstructorAllowsNullableUrlAndMimeType(): void
    {
        $sourceNoArgs = new MediaSource();
        self::assertSame([], $sourceNoArgs->toArray());

        $sourceOnlyUrl = new MediaSource('https://example.com/audio.mp3');
        self::assertSame([
            'url' => 'https://example.com/audio.mp3',
        ], $sourceOnlyUrl->toArray());

        $configured = new MediaSource('https://example.com/audio.mp3', 'audio/mp3');
        self::assertSame([
            'url' => 'https://example.com/audio.mp3',
            'mimeType' => 'audio/mp3',
        ], $configured->toArray());

        $fromMake = MediaSource::make('https://example.com/video.mp4', 'video/mp4');
        self::assertSame([
            'url' => 'https://example.com/video.mp4',
            'mimeType' => 'video/mp4',
        ], $fromMake->toArray());

        $fromMakeNoArgs = MediaSource::make();
        self::assertSame([], $fromMakeNoArgs->toArray());
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
        $card = AdaptiveCard::make()->addAction(ShowCardAction::make($innerCard, 'More'));

        $payload = $card->toArray();
        self::assertSame('Action.ShowCard', $payload['actions'][0]['type']);
        self::assertSame('AdaptiveCard', $payload['actions'][0]['card']['type']);
        self::assertTrue($card->isValid());
    }

    public function testSharedStructuresBuildAndValidation(): void
    {
        $card = AdaptiveCard::make()
            ->metadata(Metadata::make('https://adaptivecards.io'))
            ->refresh(Refresh::make()->action(ExecuteAction::make('Refresh')->verb('refreshVerb')))
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

    public function testExecuteActionConstructorAndSetters(): void
    {
        $withoutTitle = new ExecuteAction();
        self::assertSame('Action.Execute', $withoutTitle->toArray()['type']);
        self::assertArrayNotHasKey('title', $withoutTitle->toArray());

        $action = ExecuteAction::make('Submit Request')
            ->verb('submitForm')
            ->data(['ticketId' => 123])
            ->associatedInputs('Auto');

        $payload = $action->toArray();
        self::assertSame('Action.Execute', $payload['type']);
        self::assertSame('Submit Request', $payload['title']);
        self::assertSame('submitForm', $payload['verb']);
        self::assertSame(['ticketId' => 123], $payload['data']);
        self::assertSame('Auto', $payload['associatedInputs']);
    }

    public function testInsertImageActionConstructorAndSetters(): void
    {
        $action = InsertImageAction::make('https://example.com/logo.png', 'Company Logo')
            ->title('Insert Logo')
            ->insertPosition('Top');

        $payload = $action->toArray();
        self::assertSame('Action.InsertImage', $payload['type']);
        self::assertSame('https://example.com/logo.png', $payload['url']);
        self::assertSame('Company Logo', $payload['altText']);
        self::assertSame('Insert Logo', $payload['title']);
        self::assertSame('Top', $payload['insertPosition']);

        $withTitleInCtor = new InsertImageAction('https://example.com/logo.png', 'Company Logo', 'From Ctor');
        self::assertSame('From Ctor', $withTitleInCtor->toArray()['title']);

        $fromMakeWithTitle = InsertImageAction::make('https://example.com/logo.png', 'Company Logo', 'From Make');
        self::assertSame('From Make', $fromMakeWithTitle->toArray()['title']);
    }

    public function testOpenUrlActionConstructorRequiresTitleAndUrl(): void
    {
        $action = new OpenUrlAction('Open Site', 'https://example.com');
        $payload = $action->toArray();

        self::assertSame('Action.OpenUrl', $payload['type']);
        self::assertSame('Open Site', $payload['title']);
        self::assertSame('https://example.com', $payload['url']);
    }

    public function testOpenUrlDialogActionConstructorRequiresRequiredProperties(): void
    {
        $withoutTitle = new OpenUrlDialogAction('Task Modal', '500px', 'https://example.com/dialog');
        $payloadWithoutTitle = $withoutTitle->toArray();
        self::assertSame('Action.OpenUrlDialog', $payloadWithoutTitle['type']);
        self::assertArrayNotHasKey('title', $payloadWithoutTitle);
        self::assertSame('Task Modal', $payloadWithoutTitle['dialogTitle']);
        self::assertSame('500px', $payloadWithoutTitle['dialogHeight']);
        self::assertSame('https://example.com/dialog', $payloadWithoutTitle['url']);

        $action = new OpenUrlDialogAction('Task Modal', '500px', 'https://example.com/dialog', 'Open Dialog');
        $payload = $action->toArray();

        self::assertSame('Action.OpenUrlDialog', $payload['type']);
        self::assertSame('Open Dialog', $payload['title']);
        self::assertSame('Task Modal', $payload['dialogTitle']);
        self::assertSame('500px', $payload['dialogHeight']);
        self::assertSame('https://example.com/dialog', $payload['url']);

        $fromMake = OpenUrlDialogAction::make('Task Modal', 'large', 'https://example.com/dialog', 'Open Dialog');
        self::assertSame('large', $fromMake->toArray()['dialogHeight']);
        self::assertSame('Open Dialog', $fromMake->toArray()['title']);
    }

    public function testPopoverActionConstructorAllowsNullableTitle(): void
    {
        $withoutTitle = new PopoverAction();
        self::assertSame('Action.Popover', $withoutTitle->toArray()['type']);
        self::assertArrayNotHasKey('title', $withoutTitle->toArray());

        $action = new PopoverAction('More Info');
        $action->content(TextBlock::make('Popover details'))
            ->popoverTitle('Details')
            ->displayArrow(true);

        $payload = $action->toArray();
        self::assertSame('Action.Popover', $payload['type']);
        self::assertSame('More Info', $payload['title']);
        self::assertSame('Details', $payload['popoverTitle']);
        self::assertTrue($payload['displayArrow']);
        self::assertSame(['type' => 'TextBlock', 'text' => 'Popover details'], $payload['content']);

        $fromMake = PopoverAction::make('Hover Me');
        self::assertSame('Hover Me', $fromMake->toArray()['title']);

        $fromMakeNoTitle = PopoverAction::make();
        self::assertArrayNotHasKey('title', $fromMakeNoTitle->toArray());
    }

    public function testToggleVisibilityActionConstructorAllowsNullableTitle(): void
    {
        $withoutTitle = new ToggleVisibilityAction();
        self::assertSame('Action.ToggleVisibility', $withoutTitle->toArray()['type']);
        self::assertArrayNotHasKey('title', $withoutTitle->toArray());

        $action = new ToggleVisibilityAction('Toggle Section');
        $payload = $action->toArray();

        self::assertSame('Action.ToggleVisibility', $payload['type']);
        self::assertSame('Toggle Section', $payload['title']);

        $fromMake = ToggleVisibilityAction::make();
        self::assertArrayNotHasKey('title', $fromMake->toArray());
    }

    public function testSubmitActionConstructorAllowsNullableTitle(): void
    {
        $withoutTitle = new SubmitAction();
        self::assertSame('Action.Submit', $withoutTitle->toArray()['type']);
        self::assertArrayNotHasKey('title', $withoutTitle->toArray());

        $action = new SubmitAction('Submit Form');
        $payload = $action->toArray();

        self::assertSame('Action.Submit', $payload['type']);
        self::assertSame('Submit Form', $payload['title']);

        $fromMake = SubmitAction::make();
        self::assertArrayNotHasKey('title', $fromMake->toArray());
    }

    public function testResetInputsActionConstructorAllowsNullableTitle(): void
    {
        $withoutTitle = new ResetInputsAction();
        self::assertSame('Action.ResetInputs', $withoutTitle->toArray()['type']);
        self::assertArrayNotHasKey('title', $withoutTitle->toArray());

        $action = new ResetInputsAction('Reset Fields');
        $action->targetInputIds(['input1', 'input2']);
        $payload = $action->toArray();

        self::assertSame('Action.ResetInputs', $payload['type']);
        self::assertSame('Reset Fields', $payload['title']);
        self::assertSame(['input1', 'input2'], $payload['targetInputIds']);

        $fromMake = ResetInputsAction::make();
        self::assertArrayNotHasKey('title', $fromMake->toArray());
    }

    public function testShowCardActionConstructorRequiresCardWithNullableTitle(): void
    {
        $inner = AdaptiveCard::make()->addTextBlock('Inner');
        $withoutTitle = new ShowCardAction($inner);
        $payloadWithoutTitle = $withoutTitle->toArray();

        self::assertSame('Action.ShowCard', $payloadWithoutTitle['type']);
        self::assertArrayNotHasKey('title', $payloadWithoutTitle);
        self::assertSame('AdaptiveCard', $payloadWithoutTitle['card']['type']);

        $action = new ShowCardAction($inner, 'View Details');
        $payload = $action->toArray();

        self::assertSame('Action.ShowCard', $payload['type']);
        self::assertSame('View Details', $payload['title']);
        self::assertSame('AdaptiveCard', $payload['card']['type']);

        $fromMake = ShowCardAction::make($inner);
        self::assertArrayNotHasKey('title', $fromMake->toArray());
    }

    public function testBadgeConstructorRequiresTitleWithNullableSizeAndStyle(): void
    {
        $badgeOnlyTitle = new Badge('New');
        self::assertSame([
            'type' => 'Badge',
            'text' => 'New',
        ], $badgeOnlyTitle->toArray());

        $badgeWithSizeAndStyle = new Badge('Important', BadgeSize::Large, BadgeStyle::Attention);
        self::assertSame([
            'type' => 'Badge',
            'text' => 'Important',
            'size' => 'Large',
            'style' => 'Attention',
        ], $badgeWithSizeAndStyle->toArray());

        $badgeFromMakeWithStrings = Badge::make('Status', 'Medium', 'Good');
        self::assertSame([
            'type' => 'Badge',
            'text' => 'Status',
            'size' => 'Medium',
            'style' => 'Good',
        ], $badgeFromMakeWithStrings->toArray());
    }

    public function testCodeBlockConstructorTakesNoArguments(): void
    {
        $codeBlock = (new CodeBlock())
            ->codeSnippet('echo "Hello World";')
            ->language('Php')
            ->startLineNumber(10);

        self::assertSame([
            'type' => 'CodeBlock',
            'codeSnippet' => 'echo "Hello World";',
            'language' => 'Php',
            'startLineNumber' => 10,
        ], $codeBlock->toArray());

        $fromMake = CodeBlock::make();
        self::assertSame(['type' => 'CodeBlock'], $fromMake->toArray());
    }

    public function testCompoundButtonConstructorAllowsNullableTitleAndDescription(): void
    {
        $buttonNoArgs = new CompoundButton();
        self::assertSame([
            'type' => 'CompoundButton',
        ], $buttonNoArgs->toArray());

        $buttonOnlyTitle = new CompoundButton('Primary Action');
        self::assertSame([
            'type' => 'CompoundButton',
            'title' => 'Primary Action',
        ], $buttonOnlyTitle->toArray());

        $buttonWithDescription = new CompoundButton('Deploy', 'Triggers deployment pipeline');
        self::assertSame([
            'type' => 'CompoundButton',
            'title' => 'Deploy',
            'description' => 'Triggers deployment pipeline',
        ], $buttonWithDescription->toArray());

        $buttonFromMake = CompoundButton::make('Cancel', null);
        self::assertSame([
            'type' => 'CompoundButton',
            'title' => 'Cancel',
        ], $buttonFromMake->toArray());

        $buttonFromMakeNoArgs = CompoundButton::make();
        self::assertSame([
            'type' => 'CompoundButton',
        ], $buttonFromMakeNoArgs->toArray());
    }

    public function testFactSetConstructorTakesNoArguments(): void
    {
        $factSet = new FactSet();
        $factSet->fact('Key1', 'Val1')
            ->addFact(Fact::make('Key2', 'Val2'))
            ->facts(['Key3' => 'Val3', 'Key4' => 'Val4']);

        self::assertSame([
            'type' => 'FactSet',
            'facts' => [
                ['title' => 'Key1', 'value' => 'Val1'],
                ['title' => 'Key2', 'value' => 'Val2'],
                ['title' => 'Key3', 'value' => 'Val3'],
                ['title' => 'Key4', 'value' => 'Val4'],
            ],
        ], $factSet->toArray());

        $fromMake = FactSet::make();
        self::assertSame(['type' => 'FactSet'], $fromMake->toArray());
    }

    public function testIconConstructorTakesNoArguments(): void
    {
        $icon = (new Icon())
            ->name('Search')
            ->color('Accent')
            ->size('Large')
            ->style('Regular');

        self::assertSame([
            'type' => 'Icon',
            'name' => 'Search',
            'color' => 'accent',
            'size' => 'Large',
            'style' => 'Regular',
        ], $icon->toArray());

        $fromMake = Icon::make();
        self::assertSame(['type' => 'Icon'], $fromMake->toArray());
    }

    public function testImageConstructorTakesNoArguments(): void
    {
        $image = (new Image())
            ->url('https://example.com/photo.jpg')
            ->altText('Sample Photo')
            ->size('medium');

        self::assertSame([
            'type' => 'Image',
            'url' => 'https://example.com/photo.jpg',
            'altText' => 'Sample Photo',
            'size' => 'medium',
        ], $image->toArray());

        $fromMake = Image::make();
        self::assertSame(['type' => 'Image'], $fromMake->toArray());
    }

    public function testProgressBarConstructorTakesNoArguments(): void
    {
        $bar = (new ProgressBar())
            ->value(75)
            ->max(150)
            ->color('Good');

        self::assertSame([
            'type' => 'ProgressBar',
            'value' => 75,
            'max' => 150,
            'color' => 'Good',
        ], $bar->toArray());

        $fromMake = ProgressBar::make();
        self::assertSame(['type' => 'ProgressBar'], $fromMake->toArray());
    }

    public function testProgressRingConstructorWithNullableLabel(): void
    {
        $ringWithLabel = new ProgressRing('Processing...');
        self::assertSame([
            'type' => 'ProgressRing',
            'label' => 'Processing...',
        ], $ringWithLabel->toArray());

        $ringWithoutLabel = new ProgressRing();
        self::assertSame(['type' => 'ProgressRing'], $ringWithoutLabel->toArray());

        $ringFromMake = ProgressRing::make('Saving');
        self::assertSame([
            'type' => 'ProgressRing',
            'label' => 'Saving',
        ], $ringFromMake->toArray());
    }

    public function testRatingConstructorTakesNoArguments(): void
    {
        $rating = (new Rating())
            ->value(4.5)
            ->max(5)
            ->count(120)
            ->size('Large')
            ->color('Marigold')
            ->style('Compact');

        self::assertSame([
            'type' => 'Rating',
            'value' => 4.5,
            'max' => 5,
            'count' => 120,
            'size' => 'Large',
            'color' => 'Marigold',
            'style' => 'Compact',
        ], $rating->toArray());

        $fromMake = Rating::make();
        self::assertSame(['type' => 'Rating'], $fromMake->toArray());
    }

    public function testRichTextBlockConstructorWithNullableInlines(): void
    {
        $empty = new RichTextBlock();
        self::assertSame(['type' => 'RichTextBlock'], $empty->toArray());

        $rtb = new RichTextBlock([
            'Hello ',
            TextRun::make('World')->weight('bolder'),
        ]);

        self::assertSame([
            'type' => 'RichTextBlock',
            'inlines' => [
                'Hello ',
                ['type' => 'TextRun', 'text' => 'World', 'weight' => 'bolder'],
            ],
        ], $rtb->toArray());

        $fromMake = RichTextBlock::make(['Just text']);
        self::assertSame([
            'type' => 'RichTextBlock',
            'inlines' => ['Just text'],
        ], $fromMake->toArray());
    }

    public function testTableConstructorWithNullableColumnsAndRows(): void
    {
        $emptyTable = new Table();
        self::assertSame(['type' => 'Table'], $emptyTable->toArray());

        $row1 = TableRow::make()->cells([TableCell::make(), TableCell::make(), TableCell::make()]);
        $row2 = TableRow::make()->cells([TableCell::make(), TableCell::make(), TableCell::make()]);
        $row3 = TableRow::make()->cells([TableCell::make(), TableCell::make(), TableCell::make()]);

        $table = new Table([1, 1, 1], [$row1, $row2, $row3]);

        $expected = [
            'type' => 'Table',
            'columns' => [
                ['width' => 1],
                ['width' => 1],
                ['width' => 1],
            ],
            'rows' => [
                [
                    'type' => 'TableRow',
                    'cells' => [
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                    ],
                ],
                [
                    'type' => 'TableRow',
                    'cells' => [
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                    ],
                ],
                [
                    'type' => 'TableRow',
                    'cells' => [
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                        ['type' => 'TableCell'],
                    ],
                ],
            ],
        ];

        self::assertSame($expected, $table->toArray());

        $fromMake = Table::make([1, 1, 1], [$row1, $row2, $row3]);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testTextBlockConstructorWithNullableTextAndWrap(): void
    {
        $empty = new TextBlock();
        self::assertSame(['type' => 'TextBlock'], $empty->toArray());

        $blockWithWrap = new TextBlock('Headline', true);
        self::assertSame([
            'type' => 'TextBlock',
            'text' => 'Headline',
            'wrap' => true,
        ], $blockWithWrap->toArray());

        $fromMake = TextBlock::make('Summary', false);
        self::assertSame([
            'type' => 'TextBlock',
            'text' => 'Summary',
            'wrap' => false,
        ], $fromMake->toArray());

        $fromMakeNamed = TextBlock::make(wrap: true);
        self::assertSame([
            'type' => 'TextBlock',
            'wrap' => true,
        ], $fromMakeNamed->toArray());
    }

    public function testDateInputConstructorRequiresIdWithNullableLabel(): void
    {
        $inputOnlyId = new DateInput('due_date');
        self::assertSame([
            'type' => 'Input.Date',
            'id' => 'due_date',
        ], $inputOnlyId->toArray());

        $inputWithLabel = new DateInput('start_date', 'Start Date');
        self::assertSame([
            'type' => 'Input.Date',
            'id' => 'start_date',
            'label' => 'Start Date',
        ], $inputWithLabel->toArray());

        $fromMake = DateInput::make('expiry_date', 'Expiry Date');
        self::assertSame([
            'type' => 'Input.Date',
            'id' => 'expiry_date',
            'label' => 'Expiry Date',
        ], $fromMake->toArray());
    }

    public function testNumberInputConstructorRequiresIdWithNullableLabelAndPlaceholder(): void
    {
        $inputOnlyId = new NumberInput('qty');
        self::assertSame([
            'type' => 'Input.Number',
            'id' => 'qty',
        ], $inputOnlyId->toArray());

        $inputWithLabelAndPlaceholder = new NumberInput('qty', 'Quantity', 'Enter quantity');
        self::assertSame([
            'type' => 'Input.Number',
            'id' => 'qty',
            'label' => 'Quantity',
            'placeholder' => 'Enter quantity',
        ], $inputWithLabelAndPlaceholder->toArray());

        $fromMake = NumberInput::make('score', 'Score', '0-100');
        self::assertSame([
            'type' => 'Input.Number',
            'id' => 'score',
            'label' => 'Score',
            'placeholder' => '0-100',
        ], $fromMake->toArray());
    }

    public function testRatingInputConstructorRequiresIdWithNullableLabel(): void
    {
        $inputOnlyId = new RatingInput('rate_service');
        self::assertSame([
            'type' => 'Input.Rating',
            'id' => 'rate_service',
        ], $inputOnlyId->toArray());

        $inputWithLabel = new RatingInput('rate_service', 'Service Rating');
        self::assertSame([
            'type' => 'Input.Rating',
            'id' => 'rate_service',
            'label' => 'Service Rating',
        ], $inputWithLabel->toArray());

        $fromMake = RatingInput::make('rate_product', 'Product Rating');
        self::assertSame([
            'type' => 'Input.Rating',
            'id' => 'rate_product',
            'label' => 'Product Rating',
        ], $fromMake->toArray());
    }

    public function testTextInputConstructorRequiresIdWithNullableLabelAndPlaceholder(): void
    {
        $inputOnlyId = new TextInput('username');
        self::assertSame([
            'type' => 'Input.Text',
            'id' => 'username',
        ], $inputOnlyId->toArray());

        $inputWithLabelAndPlaceholder = new TextInput('username', 'User Name', 'Enter your username');
        self::assertSame([
            'type' => 'Input.Text',
            'id' => 'username',
            'label' => 'User Name',
            'placeholder' => 'Enter your username',
        ], $inputWithLabelAndPlaceholder->toArray());

        $fromMake = TextInput::make('email', 'Email Address', 'user@example.com');
        self::assertSame([
            'type' => 'Input.Text',
            'id' => 'email',
            'label' => 'Email Address',
            'placeholder' => 'user@example.com',
        ], $fromMake->toArray());
    }

    public function testTimeInputConstructorRequiresIdWithNullableLabel(): void
    {
        $inputOnlyId = new TimeInput('meeting_time');
        self::assertSame([
            'type' => 'Input.Time',
            'id' => 'meeting_time',
        ], $inputOnlyId->toArray());

        $inputWithLabel = new TimeInput('meeting_time', 'Meeting Time');
        self::assertSame([
            'type' => 'Input.Time',
            'id' => 'meeting_time',
            'label' => 'Meeting Time',
        ], $inputWithLabel->toArray());

        $fromMake = TimeInput::make('end_time', 'End Time');
        self::assertSame([
            'type' => 'Input.Time',
            'id' => 'end_time',
            'label' => 'End Time',
        ], $fromMake->toArray());
    }

    public function testToggleInputConstructorRequiresIdWithNullableTitle(): void
    {
        $inputOnlyId = new ToggleInput('agree');
        self::assertSame([
            'type' => 'Input.Toggle',
            'id' => 'agree',
        ], $inputOnlyId->toArray());

        $inputWithTitle = new ToggleInput('agree', 'I agree to terms');
        self::assertSame([
            'type' => 'Input.Toggle',
            'id' => 'agree',
            'title' => 'I agree to terms',
        ], $inputWithTitle->toArray());

        $fromMake = ToggleInput::make('subscribe', 'Subscribe to newsletter');
        self::assertSame([
            'type' => 'Input.Toggle',
            'id' => 'subscribe',
            'title' => 'Subscribe to newsletter',
        ], $fromMake->toArray());
    }

    public function testDonutChartConstructorRequiresTitleWithNullableShowTitleAndData(): void
    {
        $chartOnlyTitle = new DonutChart('Sales');
        self::assertSame([
            'type' => 'Chart.Donut',
            'title' => 'Sales',
        ], $chartOnlyTitle->toArray());

        $data = [
            ['legend' => 'Pear', 'value' => 59],
            ['legend' => 'Banana', 'value' => 292],
            ['legend' => 'Apple', 'value' => 143],
            ['legend' => 'Peach', 'value' => 98],
            ['legend' => 'Kiwi', 'value' => 179],
            ['legend' => 'Grapefruit', 'value' => 50],
            ['legend' => 'Orange', 'value' => 212],
            ['legend' => 'Cantaloupe', 'value' => 68],
        ];

        $fullChart = new DonutChart('New Chart.Donut', true, $data);
        $expected = [
            'type' => 'Chart.Donut',
            'title' => 'New Chart.Donut',
            'showTitle' => true,
            'data' => $data,
        ];
        self::assertSame($expected, $fullChart->toArray());

        $fromMake = DonutChart::make('New Chart.Donut', true, $data);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testGaugeChartConstructorRequiresTitleWithNullableShowTitleValueAndSegments(): void
    {
        $gaugeOnlyTitle = new GaugeChart('Gauge Title');
        self::assertSame([
            'type' => 'Chart.Gauge',
            'title' => 'Gauge Title',
        ], $gaugeOnlyTitle->toArray());

        $segments = [
            ['legend' => 'Low risk', 'size' => 33, 'color' => 'good'],
            ['legend' => 'Medium risk', 'size' => 34, 'color' => 'warning'],
            ['legend' => 'High risk', 'size' => 33, 'color' => 'attention'],
        ];
        $fullGauge = new GaugeChart('New Chart.Gauge', true, 50, $segments);
        $expected = [
            'type' => 'Chart.Gauge',
            'title' => 'New Chart.Gauge',
            'showTitle' => true,
            'value' => 50,
            'segments' => $segments,
        ];
        self::assertSame($expected, $fullGauge->toArray());

        $fromMake = GaugeChart::make('New Chart.Gauge', true, 50, $segments);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testHorizontalBarChartConstructorRequiresTitleAndDataWithNullableOptions(): void
    {
        $data = [
            ['x' => 'Pear', 'y' => 59],
            ['x' => 'Banana', 'y' => 292],
            ['x' => 'Apple', 'y' => 143],
            ['x' => 'Peach', 'y' => 98],
            ['x' => 'Kiwi', 'y' => 179],
            ['x' => 'Grapefruit', 'y' => 20],
        ];
        $chart = new HorizontalBarChart('New Chart.HorizontalBar', $data, true, 'Sales', 'Produce', 'diverging');
        $expected = [
            'type' => 'Chart.HorizontalBar',
            'title' => 'New Chart.HorizontalBar',
            'data' => $data,
            'showTitle' => true,
            'xAxisTitle' => 'Sales',
            'yAxisTitle' => 'Produce',
            'colorSet' => 'diverging',
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = HorizontalBarChart::make('New Chart.HorizontalBar', $data, true, 'Sales', 'Produce', 'diverging');
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testStackedHorizontalBarChartConstructorRequiresTitleAndDataWithNullableShowTitle(): void
    {
        $data = [
            [
                'title' => 'Outlook',
                'data' => [
                    ['legend' => '2023-05-01', 'value' => 24, 'color' => 'good'],
                    ['legend' => '2023-05-02', 'value' => 27, 'color' => 'warning'],
                    ['legend' => '2023-05-03', 'value' => 18, 'color' => 'attention'],
                ],
            ],
            [
                'title' => 'Teams',
                'data' => [
                    ['legend' => '2023-05-01', 'value' => 9, 'color' => 'good'],
                    ['legend' => '2023-05-02', 'value' => 100, 'color' => 'warning'],
                    ['legend' => '2023-05-03', 'value' => 22, 'color' => 'attention'],
                ],
            ],
        ];
        $chart = new StackedHorizontalBarChart('New Chart.HorizontalBar.Stacked', $data, true);
        $expected = [
            'type' => 'Chart.HorizontalBar.Stacked',
            'title' => 'New Chart.HorizontalBar.Stacked',
            'data' => $data,
            'showTitle' => true,
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = StackedHorizontalBarChart::make('New Chart.HorizontalBar.Stacked', $data, true);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testLineChartConstructorRequiresTitleWithNullableOptionsAndData(): void
    {
        $chartOnlyTitle = new LineChart('Line Sales');
        self::assertSame([
            'type' => 'Chart.Line',
            'title' => 'Line Sales',
        ], $chartOnlyTitle->toArray());

        $data = [
            [
                'legend' => 'Outlook',
                'values' => [
                    ['x' => '2023-05-01', 'y' => 99],
                    ['x' => '2023-05-02', 'y' => 6],
                ],
            ],
        ];
        $chart = new LineChart('New Chart.Line', true, 'Days', 'Sales', 'categorical', $data);
        $expected = [
            'type' => 'Chart.Line',
            'title' => 'New Chart.Line',
            'showTitle' => true,
            'xAxisTitle' => 'Days',
            'yAxisTitle' => 'Sales',
            'colorSet' => 'categorical',
            'data' => $data,
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = LineChart::make('New Chart.Line', true, 'Days', 'Sales', 'categorical', $data);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testPieChartConstructorRequiresTitleWithNullableShowTitleAndData(): void
    {
        $chartOnlyTitle = new PieChart('Pie Overview');
        self::assertSame([
            'type' => 'Chart.Pie',
            'title' => 'Pie Overview',
        ], $chartOnlyTitle->toArray());

        $data = [
            ['legend' => 'Pear', 'value' => 59],
            ['legend' => 'Banana', 'value' => 292],
        ];
        $chart = new PieChart('New Chart.Pie', true, $data);
        $expected = [
            'type' => 'Chart.Pie',
            'title' => 'New Chart.Pie',
            'showTitle' => true,
            'data' => $data,
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = PieChart::make('New Chart.Pie', true, $data);
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testVerticalBarChartConstructorRequiresTitleAndDataWithNullableOptions(): void
    {
        $data = [
            ['x' => 'Pear', 'y' => 59],
            ['x' => 'Banana', 'y' => 292],
            ['x' => 'Apple', 'y' => 143],
        ];
        $chart = new VerticalBarChart('New Chart.VerticalBar', $data, true, 'Produce', 'Sales', 'diverging');
        $expected = [
            'type' => 'Chart.VerticalBar',
            'title' => 'New Chart.VerticalBar',
            'data' => $data,
            'showTitle' => true,
            'xAxisTitle' => 'Produce',
            'yAxisTitle' => 'Sales',
            'colorSet' => 'diverging',
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = VerticalBarChart::make('New Chart.VerticalBar', $data, true, 'Produce', 'Sales', 'diverging');
        self::assertSame($expected, $fromMake->toArray());
    }

    public function testGroupedVerticalBarChartConstructorRequiresTitleWithNullableOptions(): void
    {
        $chartOnlyTitle = new GroupedVerticalBarChart('Vertical Sales');
        self::assertSame([
            'type' => 'Chart.VerticalBar.Grouped',
            'title' => 'Vertical Sales',
        ], $chartOnlyTitle->toArray());

        $data = [
            [
                'legend' => '2022',
                'values' => [
                    ['x' => 'Q1', 'y' => 100],
                    ['x' => 'Q2', 'y' => 150],
                ],
            ],
        ];
        $chart = new GroupedVerticalBarChart('New Chart.VerticalBar.Grouped', $data, true, 'Quarters', 'Revenue', 'categorical');
        $expected = [
            'type' => 'Chart.VerticalBar.Grouped',
            'title' => 'New Chart.VerticalBar.Grouped',
            'data' => $data,
            'showTitle' => true,
            'xAxisTitle' => 'Quarters',
            'yAxisTitle' => 'Revenue',
            'colorSet' => 'categorical',
        ];
        self::assertSame($expected, $chart->toArray());

        $fromMake = GroupedVerticalBarChart::make('New Chart.VerticalBar.Grouped', $data, true, 'Quarters', 'Revenue', 'categorical');
        self::assertSame($expected, $fromMake->toArray());
    }
}
