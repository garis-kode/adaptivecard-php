<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class Bug2837IconsNotRenderingInDarkModeTest extends CardFixtureTestCase
{
    public function testBuildBug2837IconsNotRenderingInDarkModeCard(): void
    {
        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Bug 2837, icons not rendering in dark mode')
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->column(Width::Auto, function (Column $c): void {
                    $c->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/work_item/assets/thumb_image.png', function (Image $img): void {
                        $img->width('56px')
                            ->height('56px')
                            ->altText('Logo')
                            ->style(ImageStyle::RoundedCorners);
                    });
                })
                ->column(Width::Stretch, function (Column $c): void {
                    $c->addTextBlock('Bug 2837 - Icons not rendering in dark mode', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->weight(TextWeight::Bolder);
                    })
                    ->addColumnSet(function (ColumnSet $innerCs): void {
                        $innerCs->targetWidth(TargetWidth::AtLeastStandard)
                            ->column(Width::Auto, function (Column $col): void {
                                $col->horizontalAlignment(HorizontalAlignment::Center)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addIcon('CircleSmall', function (Icon $i): void {
                                        $i->color(Colors::Attention)
                                            ->style(IconStyle::Filled)
                                            ->size(IconSize::Small);
                                    });
                            })
                            ->column(Width::Auto, function (Column $col): void {
                                $col->spacing(Spacing::None)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Blocked', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            })
                            ->column(Width::Auto, function (Column $col): void {
                                $col->spacing(Spacing::Small)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('|', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            })
                            ->column(Width::Auto, function (Column $col): void {
                                $col->spacing(Spacing::Small)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Hugo Gonzalez', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            });
                    });
                });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->targetWidth(TargetWidth::Narrow)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->horizontalAlignment(HorizontalAlignment::Center)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addIcon('CircleSmall', function (Icon $i): void {
                                $i->color(Colors::Attention)
                                    ->style(IconStyle::Filled)
                                    ->size(IconSize::Small);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::None)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Blocked', function (TextBlock $t): void {
                                $t->wrap(true);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('|', function (TextBlock $t): void {
                                $t->wrap(true);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Hugo Gonzalez', function (TextBlock $t): void {
                                $t->wrap(true);
                            });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->targetWidth(TargetWidth::VeryNarrow)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Auto, function (Column $c): void {
                            $c->horizontalAlignment(HorizontalAlignment::Center)
                                ->verticalContentAlignment(VerticalAlignment::Center)
                                ->addIcon('CircleSmall', function (Icon $i): void {
                                    $i->color(Colors::Attention)
                                        ->style(IconStyle::Filled)
                                        ->size(IconSize::Small);
                                });
                        })
                        ->column(Width::Auto, function (Column $c): void {
                            $c->spacing(Spacing::None)
                                ->verticalContentAlignment(VerticalAlignment::Center)
                                ->addTextBlock('Blocked', function (TextBlock $t): void {
                                    $t->wrap(true);
                                });
                        });
                    })
                    ->addTextBlock('Hugo Gonzalez', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->spacing(Spacing::None);
                    });
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(SubmitAction::make('Follow')->iconUrl('icon:Eye'));
            });

        $this->assertMatchesFixture($card, 'bug-2837-icons-not-rendering-in-dark-mode');
    }
}
