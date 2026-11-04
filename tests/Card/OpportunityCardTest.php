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
use AdaptiveCards\Element\Table\Table;
use AdaptiveCards\Element\Table\TableCell;
use AdaptiveCards\Element\Table\TableColumnDefinition;
use AdaptiveCards\Element\Table\TableRow;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
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

final class OpportunityCardTest extends CardFixtureTestCase
{
    public function testBuildOpportunityCard(): void
    {
        $toggleTargets = [
            TargetElement::make('showMore1'),
            TargetElement::make('showLess1'),
            TargetElement::make('showMore2'),
            TargetElement::make('showLess2'),
            TargetElement::make('chevronDown1'),
            TargetElement::make('chevronUp1'),
            TargetElement::make('chevronDown2'),
            TargetElement::make('chevronUp2'),
            TargetElement::make('moreText'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->column(Width::Stretch, function (Column $c): void {
                    $c->verticalContentAlignment(VerticalAlignment::Center)
                        ->addTextBlock('Fourth Coffee Distillery Equipment ', function (TextBlock $t): void {
                            $t->size(TextSize::Large)
                                ->weight(TextWeight::Bolder)
                                ->wrap(true);
                        });
                })
                ->column(Width::Auto, function (Column $c): void {
                    $c->targetWidth(TargetWidth::AtLeastStandard)
                        ->spacing(Spacing::Small)
                        ->addTextBlock('Status', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->size(TextSize::Small)
                                ->weight(TextWeight::Default)
                                ->isSubtle(true);
                        })
                        ->addTextBlock('In Progress', function (TextBlock $t): void {
                            $t->color(Colors::Good)
                                ->spacing(Spacing::None)
                                ->size(TextSize::Small)
                                ->weight(TextWeight::Bolder)
                                ->wrap(true);
                        });
                })
                ->column(Width::Auto, function (Column $c): void {
                    $c->targetWidth(TargetWidth::AtLeastStandard)
                        ->separator(true)
                        ->addTextBlock('Opportunity Score', function (TextBlock $t): void {
                            $t->size(TextSize::Small)
                                ->weight(TextWeight::Default)
                                ->isSubtle(true)
                                ->wrap(true);
                        })
                        ->addTextBlock('91 - Grade A', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->weight(TextWeight::Bolder)
                                ->spacing(Spacing::None)
                                ->size(TextSize::Small)
                                ->color(Colors::Default);
                        });
                });
            })
            ->addTextBlock('Opportunity', function (TextBlock $t): void {
                $t->wrap(true)
                    ->isSubtle(true)
                    ->spacing(Spacing::None);
            })
            ->addTextBlock('In Progress', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtMostNarrow)
                    ->color(Colors::Good)
                    ->weight(TextWeight::Bolder)
                    ->wrap(true);
            })
            ->addTextBlock('91 - Grade A', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtMostNarrow)
                    ->weight(TextWeight::Bolder)
                    ->spacing(Spacing::None)
                    ->color(Colors::Default)
                    ->wrap(true);
            })
            ->addTable(function (Table $table): void {
                $table->targetWidth(TargetWidth::Narrow)
                    ->addColumns(TableColumnDefinition::make(2))
                    ->addColumns(TableColumnDefinition::make(3))
                    ->addRows(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCells(
                                TableCell::make()->addTextBlock('Account', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCells(
                                TableCell::make()->addTextBlock('Fourth Coffee', function (TextBlock $t): void {
                                    $t->wrap(true);
                                })
                            )
                    )
                    ->addRows(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCells(
                                TableCell::make()->addTextBlock('Est. Revenue', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCells(
                                TableCell::make()->addTextBlock('$3,000,000.00', function (TextBlock $t): void {
                                    $t->wrap(true);
                                })
                            )
                    )
                    ->addRows(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCells(
                                TableCell::make()->addTextBlock('Owner', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCells(
                                TableCell::make()->addColumnSet(function (ColumnSet $cs): void {
                                    $cs->column(Width::Auto, function (Column $c): void {
                                        $c->verticalContentAlignment(VerticalAlignment::Center)
                                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                                $img->width('20px');
                                            });
                                    })
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->spacing(Spacing::Small)
                                            ->verticalContentAlignment(VerticalAlignment::Center)
                                            ->addTextBlock('Reta Taylor', function (TextBlock $t): void {
                                                $t->wrap(true);
                                            });
                                    });
                                })
                            )
                    )
                    ->firstRowAsHeaders(false)
                    ->showGridLines(false)
                    ->spacing(Spacing::Large)
                    ->separator(true);
            })
            ->addContainer(function (Container $cont): void {
                $cont->separator(true)
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addTextBlock('Account', function (TextBlock $t): void {
                        $t->wrap(true)->isSubtle(true);
                    })
                    ->addTextBlock('Fourth Coffee', function (TextBlock $t): void {
                        $t->wrap(true)->spacing(Spacing::None);
                    })
                    ->addTextBlock('Est. Revenue', function (TextBlock $t): void {
                        $t->wrap(true)->isSubtle(true);
                    })
                    ->addTextBlock('$3,000,000.00', function (TextBlock $t): void {
                        $t->wrap(true)->spacing(Spacing::None);
                    })
                    ->addTextBlock('Owner', function (TextBlock $t): void {
                        $t->wrap(true)->isSubtle(true);
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::None)
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                        $img->width('20px');
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->spacing(Spacing::Small)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Reta Taylor', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->targetWidth(TargetWidth::AtLeastStandard)
                    ->spacing(Spacing::Medium)
                    ->column(20, function (Column $c): void {
                        $c->addTextBlock('Account', function (TextBlock $t): void {
                            $t->wrap(true)->isSubtle(true);
                        })
                        ->addTextBlock('Fabrikam', function (TextBlock $t): void {
                            $t->wrap(true)->spacing(Spacing::None);
                        });
                    })
                    ->column(25, function (Column $c): void {
                        $c->addTextBlock('Est. Revenue', function (TextBlock $t): void {
                            $t->wrap(true)->isSubtle(true);
                        })
                        ->addTextBlock('$3,000,000.00', function (TextBlock $t): void {
                            $t->wrap(true)->spacing(Spacing::None);
                        });
                    })
                    ->column(25, function (Column $c): void {
                        $c->addTextBlock('Owner', function (TextBlock $t): void {
                            $t->wrap(true)->isSubtle(true);
                        })
                        ->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->spacing(Spacing::None)
                                ->column(Width::Auto, function (Column $col): void {
                                    $col->verticalContentAlignment(VerticalAlignment::Center)
                                        ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                            $img->width('20px');
                                        });
                                })
                                ->column(Width::Stretch, function (Column $col): void {
                                    $col->spacing(Spacing::Small)
                                        ->verticalContentAlignment(VerticalAlignment::Center)
                                        ->addTextBlock('Reta Taylor', function (TextBlock $t): void {
                                            $t->wrap(true);
                                        });
                                });
                        });
                    })
                    ->column(Width::Stretch);
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->separator(true)
                    ->spacing(Spacing::ExtraLarge)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_large.png', function (Image $img): void {
                                $img->style(ImageStyle::Person)
                                    ->width('35px');
                            });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->spacing(Spacing::Small)
                            ->addTextBlock('Mona Kane', function (TextBlock $t): void {
                                $t->wrap(true);
                            })
                            ->addTextBlock('Contact', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->spacing(Spacing::None)
                                    ->size(TextSize::Small)
                                    ->isSubtle(true);
                            });
                    })
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addColumnSet(function (ColumnSet $subCs) use ($createToggleAction): void {
                                $subCs->column(Width::Auto, function (Column $col) use ($createToggleAction): void {
                                    $col->targetWidth(TargetWidth::AtLeastNarrow)
                                        ->verticalContentAlignment(VerticalAlignment::Center)
                                        ->rtl(false)
                                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                            $rtb->id('showMore1')
                                                ->addInlines(
                                                    TextRun::make('See more')
                                                        ->selectAction($createToggleAction())
                                                );
                                        })
                                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                            $rtb->id('showLess1')
                                                ->isVisible(false)
                                                ->addInlines(
                                                    TextRun::make('See less')
                                                        ->selectAction($createToggleAction())
                                                );
                                        });
                                })
                                ->column(Width::Auto, function (Column $col) use ($createToggleAction): void {
                                    $col->targetWidth(TargetWidth::AtLeastNarrow)
                                        ->verticalContentAlignment(VerticalAlignment::Bottom)
                                        ->horizontalAlignment(HorizontalAlignment::Center)
                                        ->spacing(Spacing::None)
                                        ->addIcon('ChevronDown', function (Icon $i) use ($createToggleAction): void {
                                            $i->id('chevronDown1')
                                                ->size(IconSize::XxSmall)
                                                ->color(Colors::Accent)
                                                ->selectAction($createToggleAction());
                                        })
                                        ->addIcon('ChevronUp', function (Icon $i) use ($createToggleAction): void {
                                            $i->id('chevronUp1')
                                                ->isVisible(false)
                                                ->size(IconSize::XxSmall)
                                                ->color(Colors::Accent)
                                                ->selectAction($createToggleAction());
                                        });
                                });
                            });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->targetWidth(TargetWidth::VeryNarrow)
                    ->spacing(Spacing::Small)
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                $rtb->id('showMore2')
                                    ->addInlines(
                                        TextRun::make('See more')
                                            ->selectAction($createToggleAction())
                                    );
                            })
                            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                $rtb->id('showLess2')
                                    ->isVisible(false)
                                    ->addInlines(
                                        TextRun::make('See less')
                                            ->selectAction($createToggleAction())
                                    );
                            });
                    })
                ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                    $c->verticalContentAlignment(VerticalAlignment::Bottom)
                        ->horizontalAlignment(HorizontalAlignment::Center)
                        ->spacing(Spacing::None)
                        ->addIcon('ChevronDown', function (Icon $i) use ($createToggleAction): void {
                            $i->id('chevronDown2')
                                ->size(IconSize::XxSmall)
                                ->color(Colors::Accent)
                                ->selectAction($createToggleAction());
                        })
                        ->addIcon('ChevronUp', function (Icon $i) use ($createToggleAction): void {
                            $i->id('chevronUp2')
                                ->isVisible(false)
                                ->size(IconSize::XxSmall)
                                ->color(Colors::Accent)
                                ->selectAction($createToggleAction());
                        });
                });
            })
            ->addTextBlock('More Info', function (TextBlock $t): void {
                $t->id('moreText')
                    ->isVisible(false);
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->separator(true)
                    ->spacing(Spacing::ExtraLarge)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'View Details'));
            });

        $this->assertMatchesFixture($card, 'opportunity');
    }
}
