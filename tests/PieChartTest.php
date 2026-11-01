<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Chart\Donut\DonutChartData;
use AdaptiveCards\Chart\Pie\PieChart;
use AdaptiveCards\Enum\ChartColor;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Enum\ChartThickness;
use PHPUnit\Framework\TestCase;

final class PieChartTest extends TestCase
{
    public function testPieChartAcceptsDonutChartData(): void
    {
        $data = [
            DonutChartData::make('Pear', 59),
            DonutChartData::make('Banana', 292),
            DonutChartData::make('Apple', 143),
            DonutChartData::make('Peach', 98),
            DonutChartData::make('Kiwi', 179),
            DonutChartData::make('Grapefruit', 50),
            DonutChartData::make('Orange', 212),
            DonutChartData::make('Cantaloupe', 68),
        ];

        $chart = PieChart::make('Fruit Distribution')
            ->colorSet(ChartColorSet::Categorical)
            ->data($data);

        $expected = [
            'type' => 'Chart.Pie',
            'title' => 'Fruit Distribution',
            'colorSet' => 'categorical',
            'data' => [
                ['legend' => 'Pear', 'value' => 59],
                ['legend' => 'Banana', 'value' => 292],
                ['legend' => 'Apple', 'value' => 143],
                ['legend' => 'Peach', 'value' => 98],
                ['legend' => 'Kiwi', 'value' => 179],
                ['legend' => 'Grapefruit', 'value' => 50],
                ['legend' => 'Orange', 'value' => 212],
                ['legend' => 'Cantaloupe', 'value' => 68],
            ],
        ];

        self::assertEquals($expected, $chart->toArray());
    }

    public function testPieChartInAdaptiveCard(): void
    {
        $card = AdaptiveCard::make('1.5');
        $card->addPieChart('Fruits', false, [
            DonutChartData::make('Pear', 59),
            DonutChartData::make('Banana', 292),
        ], function (PieChart $chart): void {
            $chart->colorSet(ChartColorSet::Categorical)
                ->showOutlines(true)
                ->thickness(ChartThickness::Thick)
                ->value('100')
                ->valueColor(ChartColor::Good);
        });

        $expected = [
            '$schema' => 'http://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.5',
            'body' => [
                [
                    'type' => 'Chart.Pie',
                    'title' => 'Fruits',
                    'showTitle' => false,
                    'colorSet' => 'categorical',
                    'showOutlines' => true,
                    'thickness' => 'Thick',
                    'value' => '100',
                    'valueColor' => 'good',
                    'data' => [
                        ['legend' => 'Pear', 'value' => 59],
                        ['legend' => 'Banana', 'value' => 292],
                    ],
                ],
            ],
        ];

        self::assertEquals($expected, $card->toArray());
    }
}
