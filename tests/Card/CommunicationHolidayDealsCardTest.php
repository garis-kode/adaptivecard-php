<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

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
use AdaptiveCards\Enum\Height;
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
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class CommunicationHolidayDealsCardTest extends CardFixtureTestCase
{
    public function testBuildCommunicationHolidayDealsCard(): void
    {
        $toggleTargets = [
            TargetElement::make('likeFilled'),
            TargetElement::make('likeOutline'),
            TargetElement::make('commentLike'),
            TargetElement::make('commentUnlike'),
            TargetElement::make('likeFilled2'),
            TargetElement::make('likeOutline2'),
            TargetElement::make('commentLike2'),
            TargetElement::make('commentUnlike2'),
        ];

        $avatarUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/avatar.png';
        $heroImageUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/hero_image.png';

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Hawaii holiday escape deals start tonight')
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->targetWidth(TargetWidth::Narrow)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->addIcon('Megaphone', function (Icon $i): void {
                            $i->style(IconStyle::Filled)
                                ->size(IconSize::XxSmall)
                                ->color(Colors::Accent);
                        });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                $t->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->wrap(true);
                            });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl): void {
                $cs->targetWidth(TargetWidth::Narrow)
                    ->column(Width::Auto, function (Column $c) use ($avatarUrl): void {
                        $c->addImage($avatarUrl, function (Image $img): void {
                            $img->height(Height::Auto)
                                ->altText('Avatar of Laurence Gibertson');
                        });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->addTextBlock('Laurence Gibertson', function (TextBlock $t): void {
                            $t->weight(TextWeight::Bolder)
                                ->wrap(true);
                        })
                        ->addTextBlock('Oct 22', function (TextBlock $t): void {
                            $t->isSubtle(true)
                                ->size(TextSize::Small)
                                ->wrap(true)
                                ->spacing(Spacing::None);
                        });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl, $heroImageUrl, $toggleTargets): void {
                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                    ->column(Width::Stretch, function (Column $c) use ($avatarUrl): void {
                        $c->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->targetWidth(TargetWidth::AtLeastStandard)
                                ->column(Width::Auto, function (Column $col): void {
                                    $col->addIcon('Megaphone', function (Icon $i): void {
                                        $i->style(IconStyle::Filled)
                                            ->size(IconSize::XxSmall)
                                            ->color(Colors::Accent);
                                    });
                                })
                                ->column(Width::Stretch, function (Column $col): void {
                                    $col->spacing(Spacing::Small)
                                        ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                            $t->isSubtle(true)
                                                ->size(TextSize::Small)
                                                ->wrap(true);
                                        });
                                });
                        })
                        ->addColumnSet(function (ColumnSet $innerCs) use ($avatarUrl): void {
                            $innerCs->targetWidth(TargetWidth::AtLeastStandard)
                                ->column(Width::Auto, function (Column $col) use ($avatarUrl): void {
                                    $col->addImage($avatarUrl, function (Image $img): void {
                                        $img->height(Height::Auto)
                                            ->altText('Avatar of Laurence Gibertson');
                                    });
                                })
                                ->column(Width::Stretch, function (Column $col): void {
                                    $col->addTextBlock('Laurence Gibertson', function (TextBlock $t): void {
                                        $t->weight(TextWeight::Bolder)
                                            ->wrap(true);
                                    })
                                    ->addTextBlock('Oct 22', function (TextBlock $t): void {
                                        $t->isSubtle(true)
                                            ->size(TextSize::Small)
                                            ->wrap(true)
                                            ->spacing(Spacing::None);
                                    });
                                });
                        })
                        ->addTextBlock('Hawaii holiday escape deals start tonight!', function (TextBlock $t): void {
                            $t->size(TextSize::Large)
                                ->weight(TextWeight::Bolder)
                                ->wrap(true)
                                ->spacing(Spacing::Small);
                        })
                        ->addTextBlock('For a limited time, you can book a four night stay at luxury resort on the island of Maui for only $999 per person.', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->spacing(Spacing::Small)
                                ->maxLines(3);
                        })
                        ->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->height(Height::Stretch)
                                ->spacing(Spacing::ExtraLarge)
                                ->column(Width::Auto, function (Column $col): void {
                                    $col->verticalContentAlignment(VerticalAlignment::Bottom)
                                        ->spacing(Spacing::None)
                                        ->addIcon('ThumbLike', function (Icon $i): void {
                                            $i->horizontalAlignment(HorizontalAlignment::Right)
                                                ->id('likeOutline')
                                                ->size(IconSize::XxSmall);
                                        })
                                        ->addIcon('ThumbLike', function (Icon $i): void {
                                            $i->horizontalAlignment(HorizontalAlignment::Right)
                                                ->id('likeFilled')
                                                ->style(IconStyle::Filled)
                                                ->size(IconSize::XxSmall)
                                                ->isVisible(false);
                                        });
                                })
                                ->column(Width::Stretch, function (Column $col): void {
                                    $col->verticalContentAlignment(VerticalAlignment::Bottom)
                                        ->spacing(Spacing::Small)
                                        ->addTextBlock('26 people like this', function (TextBlock $t): void {
                                            $t->size(TextSize::Small)
                                                ->wrap(true)
                                                ->id('commentLike');
                                        })
                                        ->addTextBlock('27 people like this', function (TextBlock $t): void {
                                            $t->size(TextSize::Small)
                                                ->wrap(true)
                                                ->id('commentUnlike')
                                                ->isVisible(false);
                                        });
                                });
                        });
                    })
                    ->column(Width::Auto, function (Column $c) use ($heroImageUrl, $toggleTargets): void {
                        $c->addImage($heroImageUrl, function (Image $img): void {
                            $img->targetWidth(TargetWidth::AtLeastStandard)
                                ->width('150px')
                                ->height(Height::Auto)
                                ->altText('Beach Image')
                                ->style(ImageStyle::RoundedCorners);
                        })
                        ->addImage($heroImageUrl, function (Image $img): void {
                            $img->targetWidth(TargetWidth::Narrow)
                                ->width('100px')
                                ->height(Height::Auto)
                                ->altText('Beach Image')
                                ->style(ImageStyle::RoundedCorners);
                        })
                        ->addActionSet(function (ActionSet $as) use ($toggleTargets): void {
                            $as->targetWidth(TargetWidth::AtLeastStandard)
                                ->spacing(Spacing::Medium)
                                ->addActions(
                                    ToggleVisibilityAction::make('Like')->targetElements($toggleTargets)
                                )
                                ->addActions(
                                    SubmitAction::make('Comment')
                                );
                        });
                    });
            })
            ->addContainer(function (Container $container) use ($avatarUrl, $heroImageUrl): void {
                $container->targetWidth(TargetWidth::VeryNarrow)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Auto, function (Column $col): void {
                            $col->addIcon('Megaphone', function (Icon $i): void {
                                $i->style(IconStyle::Filled)
                                    ->size(IconSize::XxSmall)
                                    ->color(Colors::Accent);
                            });
                        })
                        ->column(Width::Stretch, function (Column $col): void {
                            $col->spacing(Spacing::Small)
                                ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                    $t->isSubtle(true)
                                        ->size(TextSize::Small)
                                        ->wrap(true);
                                });
                        });
                    })
                    ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl): void {
                        $cs->column(Width::Auto, function (Column $col) use ($avatarUrl): void {
                            $col->addImage($avatarUrl, function (Image $img): void {
                                $img->height(Height::Auto)
                                    ->altText('Avatar of Laurence Gibertson');
                            });
                        })
                        ->column(Width::Stretch, function (Column $col): void {
                            $col->addTextBlock('Laurence Gibertson', function (TextBlock $t): void {
                                $t->weight(TextWeight::Bolder)
                                    ->wrap(true);
                            })
                            ->addTextBlock('Oct 22', function (TextBlock $t): void {
                                $t->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->wrap(true)
                                    ->spacing(Spacing::None);
                            });
                        });
                    })
                    ->addTextBlock('Hawaii holiday escape deals start tonight!', function (TextBlock $t): void {
                        $t->size(TextSize::Large)
                            ->weight(TextWeight::Bolder)
                            ->wrap(true)
                            ->spacing(Spacing::Small);
                    })
                    ->addColumnSet(function (ColumnSet $cs) use ($heroImageUrl): void {
                        $cs->column(Width::Stretch, function (Column $col): void {
                            $col->addTextBlock('For a limited time, you can book a four night stay at luxury resort on the island of Maui for only $999 per person.', function (TextBlock $t): void {
                                $t->maxLines(4)
                                    ->wrap(true)
                                    ->spacing(Spacing::Small);
                            });
                        })
                        ->column(Width::Auto, function (Column $col) use ($heroImageUrl): void {
                            $col->addImage($heroImageUrl, function (Image $img): void {
                                $img->width('60px')
                                    ->style(ImageStyle::RoundedCorners);
                            });
                        });
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::ExtraLarge)
                            ->column(Width::Auto, function (Column $col): void {
                                $col->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::None)
                                    ->addIcon('ThumbLike', function (Icon $i): void {
                                        $i->horizontalAlignment(HorizontalAlignment::Right)
                                            ->id('likeOutline2')
                                            ->size(IconSize::XxSmall);
                                    })
                                    ->addIcon('ThumbLike', function (Icon $i): void {
                                        $i->horizontalAlignment(HorizontalAlignment::Right)
                                            ->id('likeFilled2')
                                            ->style(IconStyle::Filled)
                                            ->size(IconSize::XxSmall)
                                            ->isVisible(false);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $col): void {
                                $col->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::Small)
                                    ->addTextBlock('26 people like this', function (TextBlock $t): void {
                                        $t->size(TextSize::Small)
                                            ->wrap(true)
                                            ->id('commentLike2');
                                    })
                                    ->addTextBlock('27 people like this', function (TextBlock $t): void {
                                        $t->size(TextSize::Small)
                                            ->wrap(true)
                                            ->id('commentUnlike2')
                                            ->isVisible(false);
                                    });
                            });
                    });
            })
            ->addActionSet(function (ActionSet $as) use ($toggleTargets): void {
                $as->targetWidth(TargetWidth::AtMostNarrow)
                    ->spacing(Spacing::Medium)
                    ->addActions(
                        ToggleVisibilityAction::make('Like')->targetElements($toggleTargets)
                    )
                    ->addActions(
                        SubmitAction::make('Comment')
                    );
            });

        $this->assertMatchesFixture($card, 'communication-holiday-deals');
    }
}
