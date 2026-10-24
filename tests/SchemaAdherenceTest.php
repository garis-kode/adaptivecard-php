<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Chart\Data\ChartSeries;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Chart\LineChart;
use AdaptiveCards\Chart\VerticalBar\GroupedVerticalBarChart;
use AdaptiveCards\Element\Fact\Fact;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\Image\TeamsImageProperties;
use AdaptiveCards\Element\Media\CaptionSource;
use AdaptiveCards\Element\Media\MediaSource;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\Table\TableCell;
use AdaptiveCards\Element\Table\TableColumnDefinition;
use AdaptiveCards\Element\Table\TableRow;
use AdaptiveCards\Enum\AssociatedInputs;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Input\ChoiceSet\Choice;
use AdaptiveCards\Input\ChoiceSet\DataQuery;
use AdaptiveCards\Shared\AuthCardButton;
use AdaptiveCards\Shared\Authentication;
use AdaptiveCards\Shared\TeamsCardProperties;
use AdaptiveCards\Shared\TokenExchangeResource;
use PHPUnit\Framework\TestCase;

final class SchemaAdherenceTest extends TestCase
{
    public function testChartSeriesValuesSerialization(): void
    {
        $series = ChartSeries::make('2024')
            ->values([
                DataPoint::point('Jan', 10),
                DataPoint::point('Feb', 20),
            ]);

        $arr = $series->toArray();
        $this->assertSame('2024', $arr['legend']);
        $this->assertArrayHasKey('values', $arr);
        $this->assertArrayNotHasKey('data', $arr);
        $this->assertCount(2, $arr['values']);

        // Test in LineChart
        $lineChart = LineChart::make('Sales')->addSeries($series);
        $chartArr = $lineChart->toArray();
        $this->assertSame('Chart.Line', $chartArr['type']);
        $this->assertSame('Sales', $chartArr['title']);
        $this->assertSame('Jan', $chartArr['data'][0]['values'][0]['x']);
    }

    public function testImagePropertiesAdherence(): void
    {
        $teamsProps = TeamsImageProperties::make()->allowExpand(true);
        $this->assertTrue($teamsProps->toArray()['allowExpand']);

        $image = Image::make('https://example.com/pic.png')
            ->allowExpand(true)
            ->fitMode('Cover')
            ->horizontalContentAlignment(HorizontalAlignment::Center)
            ->verticalContentAlignment(VerticalAlignment::Bottom)
            ->themedUrls([['light' => 'https://example.com/l.png']])
            ->msteams($teamsProps);

        $arr = $image->toArray();
        $this->assertSame('Image', $arr['type']);
        $this->assertTrue($arr['allowExpand']);
        $this->assertSame('Cover', $arr['fitMode']);
        $this->assertSame('center', $arr['horizontalContentAlignment']);
        $this->assertSame('bottom', $arr['verticalContentAlignment']);
        $this->assertCount(1, $arr['themedUrls']);
        $this->assertTrue($arr['msteams']['allowExpand']);

        // Test msTeams camelCase flag
        $image2 = Image::make('https://example.com/pic.png')
            ->msteams(['allowExpand' => true], useCamelCaseKey: true);
        $this->assertArrayHasKey('msTeams', $image2->toArray());
    }

    public function testRichTextBlockLabelFor(): void
    {
        $rtb = RichTextBlock::make()->labelFor('inputId123');
        $this->assertSame('inputId123', $rtb->toArray()['labelFor']);
    }

    public function testFactSetters(): void
    {
        $fact = Fact::make('InitialKey', 'InitialVal')
            ->title('UpdatedKey')
            ->value('UpdatedVal');

        $arr = $fact->toArray();
        $this->assertSame('UpdatedKey', $arr['title']);
        $this->assertSame('UpdatedVal', $arr['value']);
    }

    public function testMediaSourceAndCaptionSourceSetters(): void
    {
        $mediaSource = MediaSource::make('https://example.com/v.mp4', 'video/mp4')
            ->url('https://example.com/v2.mp4')
            ->mimeType('video/webm');

        $arr = $mediaSource->toArray();
        $this->assertSame('https://example.com/v2.mp4', $arr['url']);
        $this->assertSame('video/webm', $arr['mimeType']);

        $caption = CaptionSource::make('https://example.com/c.vtt', 'vtt', 'EN')
            ->url('https://example.com/c2.vtt')
            ->mimeType('text/vtt')
            ->label('FR');

        $cArr = $caption->toArray();
        $this->assertSame('https://example.com/c2.vtt', $cArr['url']);
        $this->assertSame('text/vtt', $cArr['mimeType']);
        $this->assertSame('FR', $cArr['label']);
    }

    public function testTableColumnDefinitionAndTableRowSetters(): void
    {
        $col = TableColumnDefinition::make('50px')->width('100px');
        $this->assertSame('100px', $col->toArray()['width']);

        $cell1 = TableCell::make();
        $cell2 = TableCell::make();
        $row = TableRow::make()->cells([$cell1, $cell2]);
        $this->assertCount(2, $row->toArray()['cells']);
    }

    public function testDataQueryAssociatedInputs(): void
    {
        $query = DataQuery::make('dataset1')
            ->associatedInputs(AssociatedInputs::None);

        $arr = $query->toArray();
        $this->assertSame('Data.Query', $arr['type']);
        $this->assertSame('None', $arr['associatedInputs']);
    }

    public function testChoiceSetters(): void
    {
        $choice = Choice::make('A', '1')
            ->title('B')
            ->value('2');

        $arr = $choice->toArray();
        $this->assertSame('B', $arr['title']);
        $this->assertSame('2', $arr['value']);
    }

    public function testSubmitActionMsTeamsAlias(): void
    {
        $submit = SubmitAction::make('Submit')
            ->msteams(['feedback' => ['hide' => true]], useCamelCaseKey: true);

        $this->assertArrayHasKey('msTeams', $submit->toArray());
    }

    public function testAdaptiveCardActionsAndMsTeams(): void
    {
        $card = AdaptiveCard::make()
            ->actions([OpenUrlAction::make('Open', 'https://example.com')])
            ->msteams(TeamsCardProperties::make()->width('full'), useCamelCaseKey: true);

        $arr = $card->toArray();
        $this->assertCount(1, $arr['actions']);
        $this->assertArrayHasKey('msTeams', $arr);
        $this->assertSame('full', $arr['msTeams']['width']);
    }

    public function testToggleVisibilitySetters(): void
    {
        $target = TargetElement::make('elem1', false)
            ->elementId('elem2')
            ->isVisible(true);

        $arr = $target->toArray();
        $this->assertSame('elem2', $arr['elementId']);
        $this->assertTrue($arr['isVisible']);

        $action = ToggleVisibilityAction::make('Toggle')
            ->targetElements(['elemA', $target]);

        $actArr = $action->toArray();
        $this->assertCount(2, $actArr['targetElements']);
    }

    public function testAuthenticationTypedSubSchemas(): void
    {
        $tokenRes = TokenExchangeResource::make('req-1', 'app-id', 'https://token.com');
        $btn = AuthCardButton::make('signin', 'Login', 'https://login.com', 'https://login.com/icon.png');

        $auth = Authentication::make()
            ->text('Please sign in')
            ->connectionName('GraphAuth')
            ->tokenExchangeResource($tokenRes)
            ->addButton($btn);

        $arr = $auth->toArray();
        $this->assertSame('Please sign in', $arr['text']);
        $this->assertSame('GraphAuth', $arr['connectionName']);
        $this->assertSame('req-1', $arr['tokenExchangeResource']['id']);
        $this->assertSame('Login', $arr['buttons'][0]['title']);
    }
}
