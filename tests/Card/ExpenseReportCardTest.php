<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class ExpenseReportCardTest extends CardFixtureTestCase
{
    public function testBuildExpenseReportCard(): void
    {
        $toggleTargets = [
            TargetElement::make('reimbursement'),
            TargetElement::make('chevronUp'),
            TargetElement::make('chevronDown'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->addTextBlock("Your 'Travel to Seattle' expenses have been approved!", function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder);
            })
            ->addContainer(function (Container $cont): void {
                $cont->targetWidth(TargetWidth::VeryNarrow)
                    ->separator(true)
                    ->spacing(Spacing::Medium)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Auto, function (Column $c): void {
                            $c->addImage('https://github.com/OfficeDev/Microsoft-Teams-Card-Samples/blob/pabloas/set-2/samples/expense-report/assets/seattle.png?raw=true', function (Image $img): void {
                                $img->width('44px')
                                    ->height('44px')
                                    ->style(ImageStyle::RoundedCorners)
                                    ->altText('');
                            });
                        })
                        ->column(Width::Stretch, function (Column $c): void {
                            $c->addTextBlock('Travel to Seattle', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->weight(TextWeight::Bolder);
                            })
                            ->addColumnSet(function (ColumnSet $innerCs): void {
                                $innerCs->spacing(Spacing::ExtraSmall)
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->verticalContentAlignment(VerticalAlignment::Center)
                                            ->addIcon('CheckmarkCircle', function (Icon $i): void {
                                                $i->size(IconSize::XxSmall)
                                                    ->color(Colors::Good);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->spacing(Spacing::None)
                                            ->verticalContentAlignment(VerticalAlignment::Center)
                                            ->addTextBlock('Approved', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->size(TextSize::Small)
                                                    ->weight(TextWeight::Bolder)
                                                    ->color(Colors::Good);
                                            });
                                    });
                            });
                        });
                    })
                    ->addTextBlock('Fri, 7 Aug 2024 - Tue, 21 Aug 2024', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->size(TextSize::Small)
                            ->isSubtle(false)
                            ->color(Colors::Default)
                            ->weight(TextWeight::Bolder)
                            ->spacing(Spacing::ExtraSmall);
                    })
                    ->addTextBlock('Business trip to meet client to sign final contracts.', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->spacing(Spacing::ExtraSmall)
                            ->size(TextSize::Small)
                            ->isSubtle(true);
                    });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::Medium)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->addImage('https://github.com/OfficeDev/Microsoft-Teams-Card-Samples/blob/pabloas/set-2/samples/expense-report/assets/seattle.png?raw=true', function (Image $img): void {
                            $img->width('44px')
                                ->height('44px')
                                ->style(ImageStyle::RoundedCorners)
                                ->altText('');
                        });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->column(Width::Stretch, function (Column $col): void {
                                $col->verticalContentAlignment(VerticalAlignment::Bottom)
                                    ->addTextBlock('Travel to Seattle', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder);
                                    });
                            })
                            ->column(Width::Auto, function (Column $col): void {
                                $col->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addIcon('CheckmarkCircle', function (Icon $i): void {
                                        $i->size(IconSize::XxSmall)
                                            ->color(Colors::Good);
                                    });
                            })
                            ->column(Width::Auto, function (Column $col): void {
                                $col->spacing(Spacing::None)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Approved', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->size(TextSize::Small)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Good);
                                    });
                            });
                        })
                        ->addTextBlock('Fri, 7 Aug 2024 - Tue, 21 Aug 2024', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->size(TextSize::Small)
                                ->isSubtle(false)
                                ->weight(TextWeight::Bolder)
                                ->color(Colors::Default)
                                ->spacing(Spacing::ExtraSmall);
                        })
                        ->addTextBlock('Business trip to meet client to sign final contracts.', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->spacing(Spacing::ExtraSmall)
                                ->isSubtle(true)
                                ->size(TextSize::Small);
                        });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->horizontalAlignment(HorizontalAlignment::Right)
                    ->spacing(Spacing::ExtraLarge)
                    ->separator(true)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addIcon('Receipt', function (Icon $i): void {
                                $i->size(IconSize::XxSmall);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::ExtraSmall)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('2', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->size(TextSize::Small)
                                    ->weight(TextWeight::Bolder)
                                    ->color(Colors::Default);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addIcon('Comment', function (Icon $i): void {
                                $i->size(IconSize::XxSmall);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::ExtraSmall)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('4', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->size(TextSize::Small)
                                    ->weight(TextWeight::Bolder)
                                    ->color(Colors::Default);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Medium)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('$790.00', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->weight(TextWeight::Bolder)
                                    ->size(TextSize::Small);
                            });
                    })
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->spacing(Spacing::ExtraSmall)
                            ->addIcon('ChevronDown', function (Icon $i) use ($createToggleAction): void {
                                $i->id('chevronDown')
                                    ->size(IconSize::XSmall)
                                    ->selectAction($createToggleAction());
                            })
                            ->addIcon('ChevronUp', function (Icon $i) use ($createToggleAction): void {
                                $i->id('chevronUp')
                                    ->size(IconSize::XSmall)
                                    ->isVisible(false)
                                    ->selectAction($createToggleAction());
                            });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->id('reimbursement')
                    ->spacing(Spacing::Small)
                    ->isVisible(false)
                    ->style(ContainerStyle::Emphasis)
                    ->roundedCorners(true)
                    ->showBorder(true)
                    ->addTextBlock('Reimbursement #238-29', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->size(TextSize::Small);
                    })
                    ->addContainer(function (Container $innerCont): void {
                        $innerCont->style(ContainerStyle::Default)
                            ->roundedCorners(true)
                            ->addColumnSet(function (ColumnSet $cs): void {
                                $cs->column(Width::Auto)
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->spacing(Spacing::Small)
                                            ->addTextBlock('Receipts and itineraries', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->size(TextSize::Small);
                                            })
                                            ->addTextBlock('$890.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->targetWidth(TargetWidth::VeryNarrow)
                                                    ->weight(TextWeight::Bolder)
                                                    ->spacing(Spacing::ExtraSmall)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->horizontalAlignment(HorizontalAlignment::Right)
                                            ->targetWidth(TargetWidth::AtLeastNarrow)
                                            ->addTextBlock('$890.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->spacing(Spacing::Small);
                                    });
                            })
                            ->addColumnSet(function (ColumnSet $cs): void {
                                $cs->separator(true)
                                    ->column(Width::Auto)
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->spacing(Spacing::Small)
                                            ->addTextBlock('Non-reimbursable amount', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->size(TextSize::Small);
                                            })
                                            ->addTextBlock('$100.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->spacing(Spacing::ExtraSmall)
                                                    ->targetWidth(TargetWidth::VeryNarrow)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->horizontalAlignment(HorizontalAlignment::Right)
                                            ->targetWidth(TargetWidth::AtLeastNarrow)
                                            ->addTextBlock('$100.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->spacing(Spacing::Small);
                                    });
                            })
                            ->addColumnSet(function (ColumnSet $cs): void {
                                $cs->separator(true)
                                    ->column(Width::Auto)
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->spacing(Spacing::Small)
                                            ->addTextBlock('Cash advance', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->size(TextSize::Small);
                                            })
                                            ->addTextBlock('$50.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::ExtraSmall)
                                                    ->weight(TextWeight::Bolder)
                                                    ->targetWidth(TargetWidth::VeryNarrow)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->horizontalAlignment(HorizontalAlignment::Right)
                                            ->targetWidth(TargetWidth::AtLeastNarrow)
                                            ->addTextBlock('$50.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->spacing(Spacing::Small);
                                    });
                            })
                            ->addColumnSet(function (ColumnSet $cs): void {
                                $cs->separator(true)
                                    ->column(Width::Auto)
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->spacing(Spacing::Small)
                                            ->addColumnSet(function (ColumnSet $totalCs): void {
                                                $totalCs->spacing(Spacing::None)
                                                    ->column(Width::Auto, function (Column $col): void {
                                                        $col->targetWidth(TargetWidth::AtLeastNarrow)
                                                            ->spacing(Spacing::None)
                                                            ->addIcon('CheckmarkCircle', function (Icon $i): void {
                                                                $i->size(IconSize::XxSmall)
                                                                    ->color(Colors::Good)
                                                                    ->spacing(Spacing::None);
                                                            });
                                                    })
                                                    ->column(Width::Stretch, function (Column $col): void {
                                                        $col->spacing(Spacing::ExtraSmall)
                                                            ->addTextBlock('Total reimbursement', function (TextBlock $t): void {
                                                                $t->wrap(true)
                                                                    ->weight(TextWeight::Bolder)
                                                                    ->size(TextSize::Small)
                                                                    ->spacing(Spacing::None);
                                                            });
                                                    });
                                            })
                                            ->addColumnSet(function (ColumnSet $totalCs): void {
                                                $totalCs->spacing(Spacing::ExtraSmall)
                                                    ->targetWidth(TargetWidth::VeryNarrow)
                                                    ->column(Width::Auto, function (Column $col): void {
                                                        $col->addIcon('CheckmarkCircle', function (Icon $i): void {
                                                            $i->size(IconSize::XxSmall)
                                                                ->color(Colors::Good);
                                                        });
                                                    })
                                                    ->column(Width::Stretch, function (Column $col): void {
                                                        $col->spacing(Spacing::ExtraSmall)
                                                            ->addTextBlock('$790.00', function (TextBlock $t): void {
                                                                $t->wrap(true)
                                                                    ->weight(TextWeight::Bolder)
                                                                    ->size(TextSize::Small);
                                                            });
                                                    });
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->horizontalAlignment(HorizontalAlignment::Right)
                                            ->targetWidth(TargetWidth::AtLeastNarrow)
                                            ->addTextBlock('$790.00', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->size(TextSize::Small);
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->spacing(Spacing::Small);
                                    });
                            });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::ExtraLarge)
                    ->separator(true)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->addImage('https://github.com/OfficeDev/Microsoft-Teams-Card-Samples/blob/pabloas/set-2/samples/expense-report/assets/Avatar.png?raw=true', function (Image $img): void {
                            $img->style(ImageStyle::Person)
                                ->width('24px')
                                ->height('24px')
                                ->altText('');
                        });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                $rtb->addInlines(
                                    TextRun::make('Approved by ')
                                        ->size(TextSize::Small)
                                )
                                ->addInlines(
                                    TextRun::make('Mona Kane')
                                        ->size(TextSize::Small)
                                        ->weight(TextWeight::Bolder)
                                );
                            });
                    });
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Large)
                    ->addActions(OpenUrlAction::make('https://github.com/OfficeDev/Microsoft-Teams-Adaptive-Card-Samples', 'View statement'));
            });

        $this->assertMatchesFixture($card, 'expense-report');
    }
}
