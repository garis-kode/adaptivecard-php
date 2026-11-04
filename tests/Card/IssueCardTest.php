<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
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
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class IssueCardTest extends CardFixtureTestCase
{
    public function testBuildIssueCard(): void
    {
        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Version 2.2 performance optimization')
            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                $rtb->addInlines(
                    TextRun::make('Android Scrum Project / SSP-98')
                        ->size(TextSize::Small)
                        ->selectAction(OpenUrlAction::make('https://adaptivecards.io'))
                );
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::Small)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->addIcon('Branch', function (Icon $icon): void {
                            $icon->color(Colors::Accent);
                        });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->spacing(Spacing::Small)
                            ->addTextBlock('Version 2.2 Performance Optimization', function (TextBlock $t): void {
                                $t->size(TextSize::Large)
                                    ->weight(TextWeight::Bolder)
                                    ->wrap(true);
                            });
                    });
            })
            ->addTable(function (Table $table): void {
                $table->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addColumns(TableColumnDefinition::make(1))
                    ->addColumns(TableColumnDefinition::make(2))
                    ->addRows(
                        TableRow::make()
                            ->addCells(
                                TableCell::make()
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Status', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder);
                                    })
                            )
                            ->addCells(
                                TableCell::make()
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Waiting for Review', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    })
                            )
                    )
                    ->addRows(
                        TableRow::make()
                            ->addCells(
                                TableCell::make()
                                    ->addTextBlock('Due Date', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder);
                                    })
                            )
                            ->addCells(
                                TableCell::make()
                                    ->addTextBlock('May 21, 2023', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    })
                            )
                    )
                    ->addRows(
                        TableRow::make()
                            ->addCells(
                                TableCell::make()
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Priority', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder);
                                    })
                            )
                            ->addCells(
                                TableCell::make()
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addColumnSet(function (ColumnSet $cs): void {
                                        $cs->spacing(Spacing::Small)
                                            ->column(Width::Auto, function (Column $c): void {
                                                $c->addIcon('Flag', function (Icon $icon): void {
                                                    $icon->color(Colors::Attention)
                                                        ->size(IconSize::XSmall)
                                                        ->horizontalAlignment(HorizontalAlignment::Center);
                                                });
                                            })
                                            ->column(Width::Stretch, function (Column $c): void {
                                                $c->spacing(Spacing::Small)
                                                    ->addTextBlock('Critical', function (TextBlock $t): void {
                                                        $t->color(Colors::Attention)
                                                            ->wrap(true)
                                                            ->spacing(Spacing::Small);
                                                    });
                                            });
                                    })
                            )
                    )
                    ->addRows(
                        TableRow::make()
                            ->addCells(
                                TableCell::make()
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Assigned To', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder);
                                    })
                            )
                            ->addCells(
                                TableCell::make()
                                    ->addColumnSet(function (ColumnSet $cs): void {
                                        $cs->column(Width::Auto, function (Column $c): void {
                                            $c->verticalContentAlignment(VerticalAlignment::Center)
                                                ->horizontalAlignment(HorizontalAlignment::Center)
                                                ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/issue/assets/avatar.png', function (Image $img): void {
                                                    $img->width('16px');
                                                });
                                        })
                                        ->column(Width::Stretch, function (Column $c): void {
                                            $c->spacing(Spacing::Small)
                                                ->addTextBlock('Charlotte Waltson', function (TextBlock $t): void {
                                                    $t->wrap(true);
                                                });
                                        });
                                    })
                            )
                    )
                    ->firstRowAsHeaders(false)
                    ->showGridLines(false);
            })
            ->addContainer(function (Container $cont): void {
                $cont->targetWidth(TargetWidth::VeryNarrow)
                    ->addTextBlock('Status', function (TextBlock $t): void {
                        $t->weight(TextWeight::Bolder)
                            ->wrap(true);
                    })
                    ->addTextBlock('Waiting for Review', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->spacing(Spacing::None);
                    })
                    ->addTextBlock('Due Date', function (TextBlock $t): void {
                        $t->weight(TextWeight::Bolder)
                            ->wrap(true)
                            ->spacing(Spacing::Small);
                    })
                    ->addTextBlock('May 21, 2023', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->spacing(Spacing::None);
                    })
                    ->addTextBlock('Priority', function (TextBlock $t): void {
                        $t->weight(TextWeight::Bolder)
                            ->wrap(true)
                            ->spacing(Spacing::Small);
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::None)
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addIcon('Flag', function (Icon $icon): void {
                                        $icon->color(Colors::Attention)
                                            ->size(IconSize::XSmall)
                                            ->horizontalAlignment(HorizontalAlignment::Center);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->spacing(Spacing::Small)
                                    ->addTextBlock('Critical', function (TextBlock $t): void {
                                        $t->color(Colors::Attention)
                                            ->wrap(true)
                                            ->spacing(Spacing::Small);
                                    });
                            });
                    })
                    ->addTextBlock('Assigned To', function (TextBlock $t): void {
                        $t->weight(TextWeight::Bolder)
                            ->wrap(true)
                            ->spacing(Spacing::Small);
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::None)
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->horizontalAlignment(HorizontalAlignment::Center)
                                    ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/issue/assets/avatar.png', function (Image $img): void {
                                        $img->width('16px');
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->spacing(Spacing::Small)
                                    ->addTextBlock('Charlotte Waltson', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            });
                    });
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::ExtraLarge)
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Comment'))
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Edit Issue'));
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::ExtraLarge)
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Comment'))
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/')->iconUrl('icon:Edit'));
            });

        $this->assertMatchesFixture($card, 'issue');
    }
}
