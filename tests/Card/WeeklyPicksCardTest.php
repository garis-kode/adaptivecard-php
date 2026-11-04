<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class WeeklyPicksCardTest extends CardFixtureTestCase
{
    public function testBuildWeeklyPicksCard(): void
    {
        $assets = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/list/assets/';

        $toggleTargets = [
            'content1AndContent2' => [TargetElement::make('content1'), TargetElement::make('content2')],
            'content1AndContent3' => [TargetElement::make('content1'), TargetElement::make('content3')],
            'content2AndContent3' => [TargetElement::make('content2'), TargetElement::make('content3')],
        ];

        $toggle = static fn (array $targets): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($targets);

        $makePage = function (array $config) use ($assets, $toggle, $toggleTargets): Container {
            $page = (new Container())->id($config['id']);

            $page->addContainer(function (Container $cover) use ($assets, $config): void {
                $cover->backgroundImage(
                    BackgroundImage::make($assets . $config['image'])
                        ->verticalAlignment(VerticalAlignment::Center)
                        ->horizontalAlignment(HorizontalAlignment::Center)
                )
                    ->bleed(true)
                    ->minHeight('128px')
                    ->addItems(TextBlock::make())
                    ->selectAction(OpenUrlAction::make('https://adaptivecards.io/'));
            })
                ->addColumnSet(function (ColumnSet $cs) use ($config, $toggle, $toggleTargets): void {
                    $cs->horizontalAlignment(HorizontalAlignment::Center)
                        ->column(Width::Stretch, function (Column $c) use ($config, $toggle, $toggleTargets): void {
                            $c->horizontalAlignment(HorizontalAlignment::Center)
                                ->verticalContentAlignment(VerticalAlignment::Center)
                                ->addIcon('ChevronLeft', function (Icon $i) use ($config, $toggle, $toggleTargets): void {
                                    $i->color(Colors::Accent)
                                        ->size(IconSize::XSmall)
                                        ->horizontalAlignment(HorizontalAlignment::Right)
                                        ->selectAction($toggle($toggleTargets[$config['previous']]));
                                });
                        });

                    foreach ($config['dots'] as $index => $targetKey) {
                        $isActive = $index === $config['activeDot'];

                        $cs->column(Width::Auto, function (Column $c) use ($isActive, $targetKey, $toggle, $toggleTargets): void {
                            $c->verticalContentAlignment(VerticalAlignment::Center)
                                ->addIcon('CircleSmall', function (Icon $i) use ($isActive, $targetKey, $toggle, $toggleTargets): void {
                                    $i->color(Colors::Accent)
                                        ->size(IconSize::Small)
                                        ->horizontalAlignment(HorizontalAlignment::Center);

                                    if ($isActive) {
                                        $i->style(IconStyle::Filled);
                                    } else {
                                        $i->selectAction($toggle($toggleTargets[$targetKey]));
                                    }
                                });
                        });
                    }

                    $cs->column(Width::Stretch, function (Column $c) use ($config, $toggle, $toggleTargets): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addIcon('ChevronRight', function (Icon $i) use ($config, $toggle, $toggleTargets): void {
                                $i->color(Colors::Accent)
                                    ->size(IconSize::XSmall)
                                    ->horizontalAlignment(HorizontalAlignment::Left)
                                    ->selectAction($toggle($toggleTargets[$config['next']]));
                            });
                    });
                })
                ->addTextBlock($config['title'], function (TextBlock $t): void {
                    $t->weight(TextWeight::Bolder)
                        ->wrap(true)
                        ->horizontalAlignment(HorizontalAlignment::Center);
                })
                ->addTextBlock($config['meta'], function (TextBlock $t): void {
                    $t->isSubtle(true)
                        ->size(TextSize::Small)
                        ->wrap(true)
                        ->spacing(Spacing::None)
                        ->horizontalAlignment(HorizontalAlignment::Center);
                });

            if (!$config['isVisible']) {
                $page->isVisible(false);
            }

            return $page;
        };

        $features = [
            [
                'image' => 'ResourceImage_1.png',
                'altText' => 'Zenith Health Video',
                'meta' => 'Video · 12min',
                'title' => 'Why You Should Take a Break from Screen Time and Enjoy Nature',
                'author' => 'Zenith Health',
                'spacing' => Spacing::Medium,
            ],
            [
                'image' => 'ResourceImage_2.png',
                'altText' => 'Emma Jones Article',
                'meta' => 'Article · 5min',
                'title' => 'Stay Healthy and Productive Working from Home',
                'author' => 'Emma Jones',
                'spacing' => Spacing::Small,
            ],
            [
                'image' => 'ResourceImage_3.png',
                'altText' => 'Insightia Course',
                'meta' => 'Course · 30min',
                'title' => 'Productivity Mastery: How to Optimize Your Energy, Focus and Motivation',
                'author' => 'Insightia',
                'spacing' => Spacing::Small,
            ],
        ];

        $pages = [
            [
                'id' => 'content1',
                'isVisible' => true,
                'image' => 'ResourceImage_1_Horizontal.png',
                'title' => 'Why You Should Take a Break from Screen Time and Enjoy Nature',
                'meta' => 'Video · 12min',
                'activeDot' => 0,
                'previous' => 'content1AndContent3',
                'next' => 'content1AndContent2',
                'dots' => [null, 'content1AndContent2', 'content1AndContent3'],
            ],
            [
                'id' => 'content2',
                'isVisible' => false,
                'image' => 'ResourceImage_2_Horizontal.png',
                'title' => 'Stay Healthy and Productive Working from Home',
                'meta' => 'Article · 5min',
                'activeDot' => 1,
                'previous' => 'content1AndContent2',
                'next' => 'content2AndContent3',
                'dots' => ['content1AndContent2', null, 'content2AndContent3'],
            ],
            [
                'id' => 'content3',
                'isVisible' => false,
                'image' => 'ResourceImage_3_Horizontal.png',
                'title' => 'Productivity Mastery: How to Optimize Your Energy, Focus, and Motivation',
                'meta' => 'Course · 30min',
                'activeDot' => 2,
                'previous' => 'content2AndContent3',
                'next' => 'content1AndContent3',
                'dots' => ['content1AndContent3', 'content2AndContent3', null],
            ],
        ];

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Robin, explore your weekly picks')
            ->addTextBlock('Robin, explore your weekly picks', function (TextBlock $t): void {
                $t->size(TextSize::Large)
                    ->weight(TextWeight::Bolder)
                    ->wrap(true);
            })
            ->addTextBlock('These resources will teach you how to achieve balance in your life and work with more ease.', function (TextBlock $t): void {
                $t->wrap(true)
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::Small);
            });

        foreach ($features as $feature) {
            $card->addContainer(function (Container $cont) use ($assets, $feature): void {
                $cont->style(ContainerStyle::Emphasis)
                    ->spacing($feature['spacing'])
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addColumnSet(function (ColumnSet $cs) use ($assets, $feature): void {
                        $cs->column(Width::Auto, function (Column $c) use ($assets, $feature): void {
                            $c->addImage($assets . $feature['image'], function (Image $img) use ($feature): void {
                                $img->width('56px')
                                    ->height('56px')
                                    ->altText($feature['altText'])
                                    ->style(ImageStyle::RoundedCorners);
                            });
                        })
                        ->column(Width::Stretch, function (Column $c) use ($feature): void {
                            $c->addTextBlock($feature['meta'], function (TextBlock $t): void {
                                $t->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->wrap(true);
                            })
                            ->addTextBlock($feature['title'], function (TextBlock $t): void {
                                $t->weight(TextWeight::Bolder)
                                    ->wrap(true)
                                    ->spacing(Spacing::None);
                            })
                            ->addTextBlock($feature['author'], function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->spacing(Spacing::None);
                            });
                        });
                    })
                    ->selectAction(OpenUrlAction::make('https://adaptivecards.io/'))
                    ->roundedCorners(true)
                    ->showBorder(true);
            });
        }

        $card->addContainer(function (Container $cont) use ($makePage, $pages): void {
            $cont->targetWidth(TargetWidth::VeryNarrow)
                ->addTextBlock('Learn how to achieve balance in life and work.', function (TextBlock $t): void {
                    $t->wrap(true);
                });

            foreach ($pages as $page) {
                $cont->addItems($makePage($page));
            }
        })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Medium)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open Zenergy'))
                    ->addActions(
                        SubmitAction::make('Remind me')
                            ->iconUrl('icon:Clock')
                    );
            });

        $this->assertMatchesFixture($card, 'weekly-picks');
    }
}
