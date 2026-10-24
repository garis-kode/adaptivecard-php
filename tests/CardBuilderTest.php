<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\Rating;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\Table\Table;
use AdaptiveCards\Element\Table\TableCell;
use AdaptiveCards\Element\Table\TableColumnDefinition;
use AdaptiveCards\Element\Table\TableRow;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use PHPUnit\Framework\TestCase;

final class CardBuilderTest extends TestCase
{
    public function testBuildOpportunityCard(): void
    {
        $toggleTargets = [
            'showMore1',
            'showLess1',
            'showMore2',
            'showLess2',
            'chevronDown1',
            'chevronUp1',
            'chevronDown2',
            'chevronUp2',
            'moreText',
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            // Element 1: Header ColumnSet
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->column('stretch', function (Column $c): void {
                    $c->verticalContentAlignment(VerticalAlignment::Center)
                        ->addTextBlock('Fourth Coffee Distillery Equipment ', function (TextBlock $t): void {
                            $t->size(TextSize::Large)
                                ->weight(TextWeight::Bolder)
                                ->wrap(true);
                        });
                })
                ->column('auto', function (Column $c): void {
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
                ->column('auto', function (Column $c): void {
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
            // Element 2: Opportunity
            ->addTextBlock('Opportunity', function (TextBlock $t): void {
                $t->wrap(true)
                    ->isSubtle(true)
                    ->spacing(Spacing::None);
            })
            // Element 3: In Progress (AtMost:Narrow)
            ->addTextBlock('In Progress', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtMostNarrow)
                    ->color(Colors::Good)
                    ->weight(TextWeight::Bolder)
                    ->wrap(true);
            })
            // Element 4: 91 - Grade A (AtMost:Narrow)
            ->addTextBlock('91 - Grade A', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtMostNarrow)
                    ->weight(TextWeight::Bolder)
                    ->spacing(Spacing::None)
                    ->color(Colors::Default)
                    ->wrap(true);
            })
            // Element 5: Table
            ->addTable(function (Table $table): void {
                $table->targetWidth(TargetWidth::Narrow)
                    ->addColumn(TableColumnDefinition::make(2))
                    ->addColumn(TableColumnDefinition::make(3))
                    ->addRow(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCell(
                                TableCell::make()->addTextBlock('Account', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCell(
                                TableCell::make()->addTextBlock('Fourth Coffee', function (TextBlock $t): void {
                                    $t->wrap(true);
                                })
                            )
                    )
                    ->addRow(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCell(
                                TableCell::make()->addTextBlock('Est. Revenue', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCell(
                                TableCell::make()->addTextBlock('$3,000,000.00', function (TextBlock $t): void {
                                    $t->wrap(true);
                                })
                            )
                    )
                    ->addRow(
                        TableRow::make()
                            ->verticalCellContentAlignment(VerticalAlignment::Center)
                            ->addCell(
                                TableCell::make()->addTextBlock('Owner', function (TextBlock $t): void {
                                    $t->wrap(true)->isSubtle(true);
                                })
                            )
                            ->addCell(
                                TableCell::make()->addColumnSet(function (ColumnSet $cs): void {
                                    $cs->column('auto', function (Column $c): void {
                                        $c->verticalContentAlignment(VerticalAlignment::Center)
                                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                                $img->width('20px');
                                            });
                                    })
                                    ->column('stretch', function (Column $c): void {
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
            // Element 6: Container (VeryNarrow)
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
                            ->column('auto', function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                        $img->width('20px');
                                    });
                            })
                            ->column('stretch', function (Column $c): void {
                                $c->spacing(Spacing::Small)
                                    ->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('Reta Taylor', function (TextBlock $t): void {
                                        $t->wrap(true);
                                    });
                            });
                    });
            })
            // Element 7: ColumnSet (AtLeast:Standard)
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
                                ->column('auto', function (Column $col): void {
                                    $col->verticalContentAlignment(VerticalAlignment::Center)
                                        ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png', function (Image $img): void {
                                            $img->width('20px');
                                        });
                                })
                                ->column('stretch', function (Column $col): void {
                                    $col->spacing(Spacing::Small)
                                        ->verticalContentAlignment(VerticalAlignment::Center)
                                        ->addTextBlock('Reta Taylor', function (TextBlock $t): void {
                                            $t->wrap(true);
                                        });
                                });
                        });
                    })
                    ->column('stretch');
            })
            // Element 8: Mona Kane contact ColumnSet
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->separator(true)
                    ->spacing(Spacing::ExtraLarge)
                    ->column('auto', function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_large.png', function (Image $img): void {
                                $img->style(ImageStyle::Person)
                                    ->width('35px');
                            });
                    })
                    ->column('stretch', function (Column $c): void {
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
                    ->column('auto', function (Column $c) use ($createToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addColumnSet(function (ColumnSet $subCs) use ($createToggleAction): void {
                                $subCs->column('auto', function (Column $col) use ($createToggleAction): void {
                                    $col->targetWidth(TargetWidth::AtLeastNarrow)
                                        ->verticalContentAlignment(VerticalAlignment::Center)
                                        ->rtl(false)
                                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                            $rtb->id('showMore1')
                                                ->addTextRun('See more', function (TextRun $tr) use ($createToggleAction): void {
                                                    $tr->selectAction($createToggleAction());
                                                });
                                        })
                                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                            $rtb->id('showLess1')
                                                ->isVisible(false)
                                                ->addTextRun('See less', function (TextRun $tr) use ($createToggleAction): void {
                                                    $tr->selectAction($createToggleAction());
                                                });
                                        });
                                })
                                ->column('auto', function (Column $col) use ($createToggleAction): void {
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
            // Element 9: ColumnSet (VeryNarrow)
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->targetWidth(TargetWidth::VeryNarrow)
                    ->spacing(Spacing::Small)
                    ->column('auto', function (Column $c) use ($createToggleAction): void {
                    $c->verticalContentAlignment(VerticalAlignment::Center)
                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                            $rtb->id('showMore2')
                                ->addTextRun('See more', function (TextRun $tr) use ($createToggleAction): void {
                                    $tr->selectAction($createToggleAction());
                                });
                        })
                        ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                            $rtb->id('showLess2')
                                ->isVisible(false)
                                ->addTextRun('See less', function (TextRun $tr) use ($createToggleAction): void {
                                    $tr->selectAction($createToggleAction());
                                });
                        });
                })
                ->column('auto', function (Column $c) use ($createToggleAction): void {
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
            // Element 10: moreText TextBlock
            ->addTextBlock('More Info', function (TextBlock $t): void {
                $t->id('moreText')
                    ->isVisible(false);
            })
            // Element 11: ActionSet
            ->addActionSet(function (ActionSet $as): void {
                $as->separator(true)
                    ->spacing(Spacing::ExtraLarge)
                    ->addAction(OpenUrlAction::make('https://adaptivecards.io/', 'View Details'));
            });

        $expected = [
            '$schema' => 'https://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.6',
            'body' => [
                [
                    'type' => 'ColumnSet',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Fourth Coffee Distillery Equipment ',
                                    'size' => 'large',
                                    'weight' => 'bolder',
                                    'wrap' => true,
                                ],
                            ],
                            'verticalContentAlignment' => 'center',
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'targetWidth' => 'atLeast:Standard',
                            'spacing' => 'small',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Status',
                                    'wrap' => true,
                                    'size' => 'small',
                                    'weight' => 'default',
                                    'isSubtle' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'In Progress',
                                    'color' => 'good',
                                    'spacing' => 'none',
                                    'size' => 'small',
                                    'weight' => 'bolder',
                                    'wrap' => true,
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'targetWidth' => 'atLeast:Standard',
                            'separator' => true,
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Opportunity Score',
                                    'size' => 'small',
                                    'weight' => 'default',
                                    'isSubtle' => true,
                                    'wrap' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => '91 - Grade A',
                                    'wrap' => true,
                                    'weight' => 'bolder',
                                    'spacing' => 'none',
                                    'size' => 'small',
                                    'color' => 'default',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'Opportunity',
                    'wrap' => true,
                    'isSubtle' => true,
                    'spacing' => 'none',
                ],
                [
                    'type' => 'TextBlock',
                    'targetWidth' => 'atMost:Narrow',
                    'text' => 'In Progress',
                    'color' => 'good',
                    'weight' => 'bolder',
                    'wrap' => true,
                ],
                [
                    'type' => 'TextBlock',
                    'targetWidth' => 'atMost:Narrow',
                    'text' => '91 - Grade A',
                    'wrap' => true,
                    'weight' => 'bolder',
                    'spacing' => 'none',
                    'color' => 'default',
                ],
                [
                    'type' => 'Table',
                    'targetWidth' => 'Narrow',
                    'columns' => [
                        ['width' => 2],
                        ['width' => 3],
                    ],
                    'rows' => [
                        [
                            'type' => 'TableRow',
                            'cells' => [
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Account',
                                            'wrap' => true,
                                            'isSubtle' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Fourth Coffee',
                                            'wrap' => true,
                                        ],
                                    ],
                                ],
                            ],
                            'verticalCellContentAlignment' => 'center',
                        ],
                        [
                            'type' => 'TableRow',
                            'cells' => [
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Est. Revenue',
                                            'wrap' => true,
                                            'isSubtle' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => '$3,000,000.00',
                                            'wrap' => true,
                                        ],
                                    ],
                                ],
                            ],
                            'verticalCellContentAlignment' => 'center',
                        ],
                        [
                            'type' => 'TableRow',
                            'cells' => [
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Owner',
                                            'wrap' => true,
                                            'isSubtle' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'TableCell',
                                    'items' => [
                                        [
                                            'type' => 'ColumnSet',
                                            'columns' => [
                                                [
                                                    'type' => 'Column',
                                                    'width' => 'auto',
                                                    'items' => [
                                                        [
                                                            'type' => 'Image',
                                                            'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png',
                                                            'width' => '20px',
                                                        ],
                                                    ],
                                                    'verticalContentAlignment' => 'center',
                                                ],
                                                [
                                                    'type' => 'Column',
                                                    'width' => 'stretch',
                                                    'items' => [
                                                        [
                                                            'type' => 'TextBlock',
                                                            'text' => 'Reta Taylor',
                                                            'wrap' => true,
                                                        ],
                                                    ],
                                                    'spacing' => 'small',
                                                    'verticalContentAlignment' => 'center',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'verticalCellContentAlignment' => 'center',
                        ],
                    ],
                    'firstRowAsHeaders' => false,
                    'showGridLines' => false,
                    'spacing' => 'large',
                    'separator' => true,
                ],
                [
                    'type' => 'Container',
                    'separator' => true,
                    'targetWidth' => 'VeryNarrow',
                    'items' => [
                        [
                            'type' => 'TextBlock',
                            'text' => 'Account',
                            'wrap' => true,
                            'isSubtle' => true,
                        ],
                        [
                            'type' => 'TextBlock',
                            'text' => 'Fourth Coffee',
                            'wrap' => true,
                            'spacing' => 'none',
                        ],
                        [
                            'type' => 'TextBlock',
                            'text' => 'Est. Revenue',
                            'wrap' => true,
                            'isSubtle' => true,
                        ],
                        [
                            'type' => 'TextBlock',
                            'text' => '$3,000,000.00',
                            'wrap' => true,
                            'spacing' => 'none',
                        ],
                        [
                            'type' => 'TextBlock',
                            'text' => 'Owner',
                            'wrap' => true,
                            'isSubtle' => true,
                        ],
                        [
                            'type' => 'ColumnSet',
                            'spacing' => 'none',
                            'columns' => [
                                [
                                    'type' => 'Column',
                                    'width' => 'auto',
                                    'items' => [
                                        [
                                            'type' => 'Image',
                                            'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png',
                                            'width' => '20px',
                                        ],
                                    ],
                                    'verticalContentAlignment' => 'center',
                                ],
                                [
                                    'type' => 'Column',
                                    'width' => 'stretch',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Reta Taylor',
                                            'wrap' => true,
                                        ],
                                    ],
                                    'spacing' => 'small',
                                    'verticalContentAlignment' => 'center',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'ColumnSet',
                    'targetWidth' => 'atLeast:Standard',
                    'spacing' => 'medium',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 20,
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Account',
                                    'wrap' => true,
                                    'isSubtle' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Fabrikam',
                                    'wrap' => true,
                                    'spacing' => 'none',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 25,
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Est. Revenue',
                                    'wrap' => true,
                                    'isSubtle' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => '$3,000,000.00',
                                    'wrap' => true,
                                    'spacing' => 'none',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 25,
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Owner',
                                    'wrap' => true,
                                    'isSubtle' => true,
                                ],
                                [
                                    'type' => 'ColumnSet',
                                    'spacing' => 'none',
                                    'columns' => [
                                        [
                                            'type' => 'Column',
                                            'width' => 'auto',
                                            'items' => [
                                                [
                                                    'type' => 'Image',
                                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_small.png',
                                                    'width' => '20px',
                                                ],
                                            ],
                                            'verticalContentAlignment' => 'center',
                                        ],
                                        [
                                            'type' => 'Column',
                                            'width' => 'stretch',
                                            'items' => [
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => 'Reta Taylor',
                                                    'wrap' => true,
                                                ],
                                            ],
                                            'spacing' => 'small',
                                            'verticalContentAlignment' => 'center',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                        ],
                    ],
                ],
                [
                    'type' => 'ColumnSet',
                    'separator' => true,
                    'spacing' => 'extraLarge',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/account/assets/avatar_large.png',
                                    'style' => 'person',
                                    'width' => '35px',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Mona Kane',
                                    'wrap' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Contact',
                                    'wrap' => true,
                                    'spacing' => 'none',
                                    'size' => 'small',
                                    'isSubtle' => true,
                                ],
                            ],
                            'verticalContentAlignment' => 'center',
                            'spacing' => 'small',
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'ColumnSet',
                                    'columns' => [
                                        [
                                            'type' => 'Column',
                                            'targetWidth' => 'atLeast:Narrow',
                                            'width' => 'auto',
                                            'items' => [
                                                [
                                                    'type' => 'RichTextBlock',
                                                    'id' => 'showMore1',
                                                    'inlines' => [
                                                        [
                                                            'type' => 'TextRun',
                                                            'text' => 'See more',
                                                            'selectAction' => [
                                                                'type' => 'Action.ToggleVisibility',
                                                                'targetElements' => $toggleTargets,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'type' => 'RichTextBlock',
                                                    'id' => 'showLess1',
                                                    'isVisible' => false,
                                                    'inlines' => [
                                                        [
                                                            'type' => 'TextRun',
                                                            'text' => 'See less',
                                                            'selectAction' => [
                                                                'type' => 'Action.ToggleVisibility',
                                                                'targetElements' => $toggleTargets,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                            'verticalContentAlignment' => 'center',
                                            'rtl' => false,
                                        ],
                                        [
                                            'type' => 'Column',
                                            'targetWidth' => 'atLeast:Narrow',
                                            'width' => 'auto',
                                            'items' => [
                                                [
                                                    'type' => 'Icon',
                                                    'id' => 'chevronDown1',
                                                    'name' => 'ChevronDown',
                                                    'size' => 'xxSmall',
                                                    'color' => 'accent',
                                                    'selectAction' => [
                                                        'type' => 'Action.ToggleVisibility',
                                                        'targetElements' => $toggleTargets,
                                                    ],
                                                ],
                                                [
                                                    'type' => 'Icon',
                                                    'id' => 'chevronUp1',
                                                    'isVisible' => false,
                                                    'name' => 'ChevronUp',
                                                    'size' => 'xxSmall',
                                                    'color' => 'accent',
                                                    'selectAction' => [
                                                        'type' => 'Action.ToggleVisibility',
                                                        'targetElements' => $toggleTargets,
                                                    ],
                                                ],
                                            ],
                                            'verticalContentAlignment' => 'bottom',
                                            'horizontalAlignment' => 'center',
                                            'spacing' => 'none',
                                        ],
                                    ],
                                ],
                            ],
                            'verticalContentAlignment' => 'center',
                        ],
                    ],
                ],
                [
                    'type' => 'ColumnSet',
                    'targetWidth' => 'VeryNarrow',
                    'spacing' => 'small',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'RichTextBlock',
                                    'id' => 'showMore2',
                                    'inlines' => [
                                        [
                                            'type' => 'TextRun',
                                            'text' => 'See more',
                                            'selectAction' => [
                                                'type' => 'Action.ToggleVisibility',
                                                'targetElements' => $toggleTargets,
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'RichTextBlock',
                                    'id' => 'showLess2',
                                    'isVisible' => false,
                                    'inlines' => [
                                        [
                                            'type' => 'TextRun',
                                            'text' => 'See less',
                                            'selectAction' => [
                                                'type' => 'Action.ToggleVisibility',
                                                'targetElements' => $toggleTargets,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'verticalContentAlignment' => 'center',
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'Icon',
                                    'id' => 'chevronDown2',
                                    'name' => 'ChevronDown',
                                    'size' => 'xxSmall',
                                    'color' => 'accent',
                                    'selectAction' => [
                                        'type' => 'Action.ToggleVisibility',
                                        'targetElements' => $toggleTargets,
                                    ],
                                ],
                                [
                                    'type' => 'Icon',
                                    'id' => 'chevronUp2',
                                    'isVisible' => false,
                                    'name' => 'ChevronUp',
                                    'size' => 'xxSmall',
                                    'color' => 'accent',
                                    'selectAction' => [
                                        'type' => 'Action.ToggleVisibility',
                                        'targetElements' => $toggleTargets,
                                    ],
                                ],
                            ],
                            'verticalContentAlignment' => 'bottom',
                            'horizontalAlignment' => 'center',
                            'spacing' => 'none',
                        ],
                    ],
                ],
                [
                    'type' => 'TextBlock',
                    'id' => 'moreText',
                    'text' => 'More Info',
                    'isVisible' => false,
                ],
                [
                    'type' => 'ActionSet',
                    'separator' => true,
                    'spacing' => 'extraLarge',
                    'actions' => [
                        [
                            'type' => 'Action.OpenUrl',
                            'title' => 'View Details',
                            'url' => 'https://adaptivecards.io/',
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($expected, $card->toArray());
    }

    public function testBuildAuthorHighlightVideoCard(): void
    {
        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('3 minute energy flow with kayo video')
            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/author-highlight-video/assets/video_image.png', function (Image $img): void {
                $img->altText('3 Minute Energy Flow with Kayo Video')
                    ->style(ImageStyle::RoundedCorners);
            })
            ->addTextBlock('3 Minute Energy Flow with Kayo', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder);
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->column('auto', function (Column $c): void {
                    $c->verticalContentAlignment(VerticalAlignment::Center)
                        ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/author-highlight-video/assets/avatar.png', function (Image $img): void {
                            $img->width('24px')
                                ->pixelHeight('24px')
                                ->style(ImageStyle::Person)
                                ->altText('Avatar of Kayo Miwa');
                        });
                })
                ->column('stretch', function (Column $c): void {
                    $c->spacing(Spacing::Small)
                        ->verticalContentAlignment(VerticalAlignment::Center)
                        ->addTextBlock('Kayo Miwa', function (TextBlock $t): void {
                            $t->wrap(true);
                        });
                });
            })
            ->addTextBlock('Feeling sluggish or sleepy? Try this quick 3 minute flow to awaken your body and mind! All you need is a little space, and get ready to stretch your arms and legs.', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtLeastNarrow)
                    ->wrap(true);
            })
            ->addTextBlock('Feeling sluggish or sleepy? Try this quick 3 minute flow to awaken your body and...', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::VeryNarrow)
                    ->wrap(true);
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->addAction(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addAction(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Remind me')
                            ->iconUrl('icon:AlertUrgent')
                    );
            });

        $expected = [
            '$schema' => 'https://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.6',
            'speak' => '3 minute energy flow with kayo video',
            'body' => [
                [
                    'type' => 'Image',
                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/author-highlight-video/assets/video_image.png',
                    'altText' => '3 Minute Energy Flow with Kayo Video',
                    'style' => 'RoundedCorners',
                ],
                [
                    'type' => 'TextBlock',
                    'text' => '3 Minute Energy Flow with Kayo',
                    'wrap' => true,
                    'size' => 'large',
                    'weight' => 'bolder',
                ],
                [
                    'type' => 'ColumnSet',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/author-highlight-video/assets/avatar.png',
                                    'width' => '24px',
                                    'height' => '24px',
                                    'style' => 'person',
                                    'altText' => 'Avatar of Kayo Miwa',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'spacing' => 'small',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Kayo Miwa',
                                    'wrap' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'Feeling sluggish or sleepy? Try this quick 3 minute flow to awaken your body and mind! All you need is a little space, and get ready to stretch your arms and legs.',
                    'targetWidth' => 'atLeast:Narrow',
                    'wrap' => true,
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'Feeling sluggish or sleepy? Try this quick 3 minute flow to awaken your body and...',
                    'targetWidth' => 'VeryNarrow',
                    'wrap' => true,
                ],
                [
                    'type' => 'ActionSet',
                    'actions' => [
                        [
                            'type' => 'Action.OpenUrl',
                            'title' => 'Open',
                            'url' => 'https://adaptivecards.io/',
                        ],
                        [
                            'type' => 'Action.OpenUrl',
                            'title' => 'Remind me',
                            'url' => 'https://adaptivecards.io/',
                            'iconUrl' => 'icon:AlertUrgent',
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($expected, $card->toArray());
    }

    public function testBuildCommunicationHolidayDealsCard(): void
    {
        $toggleTargets = [
            'likeFilled',
            'likeOutline',
            'commentLike',
            'commentUnlike',
            'likeFilled2',
            'likeOutline2',
            'commentLike2',
            'commentUnlike2',
        ];

        $avatarUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/avatar.png';
        $heroImageUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/hero_image.png';

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Hawaii holiday escape deals start tonight')
            // 1. ColumnSet (Narrow)
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->targetWidth(TargetWidth::Narrow)
                    ->column('auto', function (Column $c): void {
                        $c->addIcon('Megaphone', function (Icon $i): void {
                            $i->style(IconStyle::Filled)
                                ->size(IconSize::XxSmall)
                                ->color(Colors::Accent);
                        });
                    })
                    ->column('stretch', function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                $t->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->wrap(true);
                            });
                    });
            })
            // 2. ColumnSet (Narrow)
            ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl): void {
                $cs->targetWidth(TargetWidth::Narrow)
                    ->column('auto', function (Column $c) use ($avatarUrl): void {
                        $c->addImage($avatarUrl, function (Image $img): void {
                            $img->height(Height::Auto)
                                ->altText('Avatar of Laurence Gibertson');
                        });
                    })
                    ->column('stretch', function (Column $c): void {
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
            // 3. ColumnSet (AtLeast:Narrow)
            ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl, $heroImageUrl, $toggleTargets): void {
                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                    ->column('stretch', function (Column $c) use ($avatarUrl): void {
                        // Nested ColumnSet: Posted in Employee Deals
                        $c->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->targetWidth(TargetWidth::AtLeastStandard)
                                ->column('auto', function (Column $col): void {
                                    $col->addIcon('Megaphone', function (Icon $i): void {
                                        $i->style(IconStyle::Filled)
                                            ->size(IconSize::XxSmall)
                                            ->color(Colors::Accent);
                                    });
                                })
                                ->column('stretch', function (Column $col): void {
                                    $col->spacing(Spacing::Small)
                                        ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                            $t->isSubtle(true)
                                                ->size(TextSize::Small)
                                                ->wrap(true);
                                        });
                                });
                        })
                        // Nested ColumnSet: Author & Date
                        ->addColumnSet(function (ColumnSet $innerCs) use ($avatarUrl): void {
                            $innerCs->targetWidth(TargetWidth::AtLeastStandard)
                                ->column('auto', function (Column $col) use ($avatarUrl): void {
                                    $col->addImage($avatarUrl, function (Image $img): void {
                                        $img->height(Height::Auto)
                                            ->altText('Avatar of Laurence Gibertson');
                                    });
                                })
                                ->column('stretch', function (Column $col): void {
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
                        // Nested ColumnSet: Likes
                        ->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->height(Height::Stretch)
                                ->spacing(Spacing::ExtraLarge)
                                ->column('auto', function (Column $col): void {
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
                                ->column('stretch', function (Column $col): void {
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
                    ->column('auto', function (Column $c) use ($heroImageUrl, $toggleTargets): void {
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
                                ->addAction(
                                    ToggleVisibilityAction::make('Like')->targetElements($toggleTargets)
                                )
                                ->addAction(
                                    SubmitAction::make('Comment')
                                );
                        });
                    });
            })
            // 4. Container (VeryNarrow)
            ->addContainer(function (Container $container) use ($avatarUrl, $heroImageUrl): void {
                $container->targetWidth(TargetWidth::VeryNarrow)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column('auto', function (Column $col): void {
                            $col->addIcon('Megaphone', function (Icon $i): void {
                                $i->style(IconStyle::Filled)
                                    ->size(IconSize::XxSmall)
                                    ->color(Colors::Accent);
                            });
                        })
                        ->column('stretch', function (Column $col): void {
                            $col->spacing(Spacing::Small)
                                ->addTextBlock('Posted in Employee Deals', function (TextBlock $t): void {
                                    $t->isSubtle(true)
                                        ->size(TextSize::Small)
                                        ->wrap(true);
                                });
                        });
                    })
                    ->addColumnSet(function (ColumnSet $cs) use ($avatarUrl): void {
                        $cs->column('auto', function (Column $col) use ($avatarUrl): void {
                            $col->addImage($avatarUrl, function (Image $img): void {
                                $img->height(Height::Auto)
                                    ->altText('Avatar of Laurence Gibertson');
                            });
                        })
                        ->column('stretch', function (Column $col): void {
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
                        $cs->column('stretch', function (Column $col): void {
                            $col->addTextBlock('For a limited time, you can book a four night stay at luxury resort on the island of Maui for only $999 per person.', function (TextBlock $t): void {
                                $t->maxLines(4)
                                    ->wrap(true)
                                    ->spacing(Spacing::Small);
                            });
                        })
                        ->column('auto', function (Column $col) use ($heroImageUrl): void {
                            $col->addImage($heroImageUrl, function (Image $img): void {
                                $img->width('60px')
                                    ->style(ImageStyle::RoundedCorners);
                            });
                        });
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::ExtraLarge)
                            ->column('auto', function (Column $col): void {
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
                            ->column('stretch', function (Column $col): void {
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
            // 5. ActionSet (AtMost:Narrow)
            ->addActionSet(function (ActionSet $as) use ($toggleTargets): void {
                $as->targetWidth(TargetWidth::AtMostNarrow)
                    ->spacing(Spacing::Medium)
                    ->addAction(
                        ToggleVisibilityAction::make('Like')->targetElements($toggleTargets)
                    )
                    ->addAction(
                        SubmitAction::make('Comment')
                    );
            });

        $expected = [
            '$schema' => 'https://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.6',
            'speak' => 'Hawaii holiday escape deals start tonight',
            'body' => [
                [
                    'type' => 'ColumnSet',
                    'targetWidth' => 'Narrow',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'Icon',
                                    'name' => 'Megaphone',
                                    'style' => 'Filled',
                                    'size' => 'xxSmall',
                                    'color' => 'accent',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'spacing' => 'small',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Posted in Employee Deals',
                                    'isSubtle' => true,
                                    'size' => 'small',
                                    'wrap' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'ColumnSet',
                    'targetWidth' => 'Narrow',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/avatar.png',
                                    'height' => 'auto',
                                    'altText' => 'Avatar of Laurence Gibertson',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Laurence Gibertson',
                                    'weight' => 'bolder',
                                    'wrap' => true,
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Oct 22',
                                    'isSubtle' => true,
                                    'size' => 'small',
                                    'wrap' => true,
                                    'spacing' => 'none',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'ColumnSet',
                    'targetWidth' => 'atLeast:Narrow',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'stretch',
                            'items' => [
                                [
                                    'type' => 'ColumnSet',
                                    'targetWidth' => 'atLeast:Standard',
                                    'columns' => [
                                        [
                                            'type' => 'Column',
                                            'width' => 'auto',
                                            'items' => [
                                                [
                                                    'type' => 'Icon',
                                                    'name' => 'Megaphone',
                                                    'style' => 'Filled',
                                                    'size' => 'xxSmall',
                                                    'color' => 'accent',
                                                ],
                                            ],
                                        ],
                                        [
                                            'type' => 'Column',
                                            'width' => 'stretch',
                                            'spacing' => 'small',
                                            'items' => [
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => 'Posted in Employee Deals',
                                                    'isSubtle' => true,
                                                    'size' => 'small',
                                                    'wrap' => true,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'ColumnSet',
                                    'targetWidth' => 'atLeast:Standard',
                                    'columns' => [
                                        [
                                            'type' => 'Column',
                                            'width' => 'auto',
                                            'items' => [
                                                [
                                                    'type' => 'Image',
                                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/avatar.png',
                                                    'height' => 'auto',
                                                    'altText' => 'Avatar of Laurence Gibertson',
                                                ],
                                            ],
                                        ],
                                        [
                                            'type' => 'Column',
                                            'width' => 'stretch',
                                            'items' => [
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => 'Laurence Gibertson',
                                                    'weight' => 'bolder',
                                                    'wrap' => true,
                                                ],
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => 'Oct 22',
                                                    'isSubtle' => true,
                                                    'size' => 'small',
                                                    'wrap' => true,
                                                    'spacing' => 'none',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Hawaii holiday escape deals start tonight!',
                                    'size' => 'large',
                                    'weight' => 'bolder',
                                    'wrap' => true,
                                    'spacing' => 'small',
                                ],
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'For a limited time, you can book a four night stay at luxury resort on the island of Maui for only $999 per person.',
                                    'maxLines' => 3,
                                    'wrap' => true,
                                    'spacing' => 'small',
                                ],
                                [
                                    'type' => 'ColumnSet',
                                    'height' => 'stretch',
                                    'spacing' => 'extraLarge',
                                    'columns' => [
                                        [
                                            'type' => 'Column',
                                            'width' => 'auto',
                                            'verticalContentAlignment' => 'bottom',
                                            'spacing' => 'none',
                                            'items' => [
                                                [
                                                    'type' => 'Icon',
                                                    'name' => 'ThumbLike',
                                                    'horizontalAlignment' => 'right',
                                                    'id' => 'likeOutline',
                                                    'size' => 'xxSmall',
                                                ],
                                                [
                                                    'type' => 'Icon',
                                                    'name' => 'ThumbLike',
                                                    'horizontalAlignment' => 'right',
                                                    'id' => 'likeFilled',
                                                    'style' => 'Filled',
                                                    'size' => 'xxSmall',
                                                    'isVisible' => false,
                                                ],
                                            ],
                                        ],
                                        [
                                            'type' => 'Column',
                                            'width' => 'stretch',
                                            'verticalContentAlignment' => 'bottom',
                                            'spacing' => 'small',
                                            'items' => [
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => '26 people like this',
                                                    'size' => 'small',
                                                    'wrap' => true,
                                                    'id' => 'commentLike',
                                                ],
                                                [
                                                    'type' => 'TextBlock',
                                                    'text' => '27 people like this',
                                                    'size' => 'small',
                                                    'wrap' => true,
                                                    'id' => 'commentUnlike',
                                                    'isVisible' => false,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'items' => [
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/hero_image.png',
                                    'width' => '150px',
                                    'height' => 'auto',
                                    'style' => 'RoundedCorners',
                                    'altText' => 'Beach Image',
                                    'targetWidth' => 'atLeast:Standard',
                                ],
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/hero_image.png',
                                    'width' => '100px',
                                    'height' => 'auto',
                                    'style' => 'RoundedCorners',
                                    'altText' => 'Beach Image',
                                    'targetWidth' => 'Narrow',
                                ],
                                [
                                    'type' => 'ActionSet',
                                    'targetWidth' => 'atLeast:Standard',
                                    'spacing' => 'medium',
                                    'actions' => [
                                        [
                                            'type' => 'Action.ToggleVisibility',
                                            'title' => 'Like',
                                            'targetElements' => [
                                                'likeFilled',
                                                'likeOutline',
                                                'commentLike',
                                                'commentUnlike',
                                                'likeFilled2',
                                                'likeOutline2',
                                                'commentLike2',
                                                'commentUnlike2',
                                            ],
                                        ],
                                        [
                                            'type' => 'Action.Submit',
                                            'title' => 'Comment',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'Container',
                    'targetWidth' => 'VeryNarrow',
                    'items' => [
                        [
                            'type' => 'ColumnSet',
                            'columns' => [
                                [
                                    'type' => 'Column',
                                    'width' => 'auto',
                                    'items' => [
                                        [
                                            'type' => 'Icon',
                                            'name' => 'Megaphone',
                                            'style' => 'Filled',
                                            'size' => 'xxSmall',
                                            'color' => 'accent',
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'Column',
                                    'width' => 'stretch',
                                    'spacing' => 'small',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Posted in Employee Deals',
                                            'isSubtle' => true,
                                            'size' => 'small',
                                            'wrap' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'ColumnSet',
                            'columns' => [
                                [
                                    'type' => 'Column',
                                    'width' => 'auto',
                                    'items' => [
                                        [
                                            'type' => 'Image',
                                            'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/avatar.png',
                                            'height' => 'auto',
                                            'altText' => 'Avatar of Laurence Gibertson',
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'Column',
                                    'width' => 'stretch',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Laurence Gibertson',
                                            'weight' => 'bolder',
                                            'wrap' => true,
                                        ],
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'Oct 22',
                                            'isSubtle' => true,
                                            'size' => 'small',
                                            'wrap' => true,
                                            'spacing' => 'none',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'TextBlock',
                            'text' => 'Hawaii holiday escape deals start tonight!',
                            'size' => 'large',
                            'weight' => 'bolder',
                            'wrap' => true,
                            'spacing' => 'small',
                        ],
                        [
                            'type' => 'ColumnSet',
                            'columns' => [
                                [
                                    'type' => 'Column',
                                    'width' => 'stretch',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => 'For a limited time, you can book a four night stay at luxury resort on the island of Maui for only $999 per person.',
                                            'maxLines' => 4,
                                            'wrap' => true,
                                            'spacing' => 'small',
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'Column',
                                    'width' => 'auto',
                                    'items' => [
                                        [
                                            'type' => 'Image',
                                            'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/communication/assets/hero_image.png',
                                            'width' => '60px',
                                            'style' => 'RoundedCorners',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'ColumnSet',
                            'spacing' => 'extraLarge',
                            'columns' => [
                                [
                                    'type' => 'Column',
                                    'width' => 'auto',
                                    'verticalContentAlignment' => 'center',
                                    'spacing' => 'none',
                                    'items' => [
                                        [
                                            'type' => 'Icon',
                                            'name' => 'ThumbLike',
                                            'horizontalAlignment' => 'right',
                                            'id' => 'likeOutline2',
                                            'size' => 'xxSmall',
                                        ],
                                        [
                                            'type' => 'Icon',
                                            'name' => 'ThumbLike',
                                            'horizontalAlignment' => 'right',
                                            'id' => 'likeFilled2',
                                            'style' => 'Filled',
                                            'size' => 'xxSmall',
                                            'isVisible' => false,
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'Column',
                                    'width' => 'stretch',
                                    'verticalContentAlignment' => 'center',
                                    'spacing' => 'small',
                                    'items' => [
                                        [
                                            'type' => 'TextBlock',
                                            'text' => '26 people like this',
                                            'size' => 'small',
                                            'wrap' => true,
                                            'id' => 'commentLike2',
                                        ],
                                        [
                                            'type' => 'TextBlock',
                                            'text' => '27 people like this',
                                            'size' => 'small',
                                            'wrap' => true,
                                            'id' => 'commentUnlike2',
                                            'isVisible' => false,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'ActionSet',
                    'targetWidth' => 'atMost:Narrow',
                    'spacing' => 'medium',
                    'actions' => [
                        [
                            'type' => 'Action.ToggleVisibility',
                            'title' => 'Like',
                            'targetElements' => [
                                'likeFilled',
                                'likeOutline',
                                'commentLike',
                                'commentUnlike',
                                'likeFilled2',
                                'likeOutline2',
                                'commentLike2',
                                'commentUnlike2',
                            ],
                        ],
                        [
                            'type' => 'Action.Submit',
                            'title' => 'Comment',
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($expected, $card->toArray());
    }

    public function testBuildCourseVideoCard(): void
    {
        $toggleTargets = [
            'truncatedText',
            'fullText',
            'showMore',
            'showLess',
        ];

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Intro to graphic design, concepts video')
            // 1. Image with selectAction
            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/video_image.png', function (Image $img): void {
                $img->selectAction(
                    OpenUrlAction::make('https://adaptivecards.io/')
                        ->tooltip('Intro to Graphic Design: Concepts Video')
                )->style(ImageStyle::RoundedCorners);
            })
            // 2. TextBlock Header
            ->addTextBlock('Intro to Graphic Design: Concepts', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder);
            })
            // 3. Rating
            ->addRating(4, 5, function (Rating $r): void {
                $r->count(1160)
                    ->color(RatingColor::Marigold)
                    ->size(RatingSize::Medium)
                    ->fallback(
                        TextBlock::make('4 Stars · 1,160')->spacing(Spacing::None)
                    )
                    ->spacing(Spacing::None);
            })
            // 4. TextBlock
            ->addTextBlock('Course · 52m · Beginner', function (TextBlock $t): void {
                $t->wrap(true)
                    ->isSubtle(true)
                    ->spacing(Spacing::Small);
            })
            // 5. ColumnSet (Logo + Authors)
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::None)
                    ->column('auto', function (Column $c): void {
                        $c->horizontalAlignment(HorizontalAlignment::Center)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/logo_image.png', function (Image $img): void {
                                $img->width('16px')
                                    ->pixelHeight('16px')
                                    ->altText('Logo');
                            });
                    })
                    ->column('auto', function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Sketchpad Scholars', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->weight(TextWeight::Bolder);
                        });
                    })
                    ->column('auto', function (Column $c): void {
                        $c->targetWidth(TargetWidth::AtLeastStandard)
                            ->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('·');
                    })
                    ->column('auto', function (Column $c): void {
                        $c->targetWidth(TargetWidth::AtLeastStandard)
                            ->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Tony Harper', function (TextBlock $t): void {
                            $t->wrap(true);
                        });
                    });
            })
            // 6. TextBlock (truncatedText)
            ->addTextBlock('This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn...', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtLeastNarrow)
                    ->wrap(true)
                    ->id('truncatedText');
            })
            // 7. TextBlock (fullText)
            ->addTextBlock('This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn about design principles through hands-on projects that will help build your portfolio. Enroll now and start your journey to mastering the art of graphic design.', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtLeastNarrow)
                    ->wrap(true)
                    ->isVisible(false)
                    ->id('fullText');
            })
            // 8. RichTextBlock (showMore)
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($toggleTargets): void {
                $rtb->id('showMore')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::None)
                    ->addTextRun('Show more', function (TextRun $tr) use ($toggleTargets): void {
                        $tr->selectAction(
                            ToggleVisibilityAction::make()->targetElements($toggleTargets)
                        );
                    });
            })
            // 9. RichTextBlock (showLess)
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($toggleTargets): void {
                $rtb->id('showLess')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::None)
                    ->isVisible(false)
                    ->addTextRun('Show less', function (TextRun $tr) use ($toggleTargets): void {
                        $tr->selectAction(
                            ToggleVisibilityAction::make()->targetElements($toggleTargets)
                        );
                    });
            })
            // 10. ActionSet (AtLeast:Narrow)
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Large)
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addAction(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addAction(ExecuteAction::make('Bookmark')->iconUrl('icon:Bookmark'));
            })
            // 11. ActionSet (VeryNarrow)
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Large)
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addAction(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addAction(ExecuteAction::make()->iconUrl('icon:Bookmark'));
            });

        $expected = [
            '$schema' => 'https://adaptivecards.io/schemas/adaptive-card.json',
            'type' => 'AdaptiveCard',
            'version' => '1.6',
            'speak' => 'Intro to graphic design, concepts video',
            'body' => [
                [
                    'type' => 'Image',
                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/video_image.png',
                    'selectAction' => [
                        'type' => 'Action.OpenUrl',
                        'url' => 'https://adaptivecards.io/',
                        'tooltip' => 'Intro to Graphic Design: Concepts Video',
                    ],
                    'style' => 'RoundedCorners',
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'Intro to Graphic Design: Concepts',
                    'wrap' => true,
                    'size' => 'large',
                    'weight' => 'bolder',
                ],
                [
                    'type' => 'Rating',
                    'value' => 4,
                    'count' => 1160,
                    'color' => 'Marigold',
                    'size' => 'Medium',
                    'fallback' => [
                        'type' => 'TextBlock',
                        'text' => '4 Stars · 1,160',
                        'spacing' => 'none',
                    ],
                    'spacing' => 'none',
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'Course · 52m · Beginner',
                    'wrap' => true,
                    'isSubtle' => true,
                    'spacing' => 'small',
                ],
                [
                    'type' => 'ColumnSet',
                    'spacing' => 'none',
                    'columns' => [
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'horizontalAlignment' => 'center',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'Image',
                                    'url' => 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/logo_image.png',
                                    'width' => '16px',
                                    'height' => '16px',
                                    'altText' => 'Logo',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'spacing' => 'small',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Sketchpad Scholars',
                                    'wrap' => true,
                                    'weight' => 'bolder',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'targetWidth' => 'atLeast:Standard',
                            'spacing' => 'small',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => '·',
                                ],
                            ],
                        ],
                        [
                            'type' => 'Column',
                            'width' => 'auto',
                            'targetWidth' => 'atLeast:Standard',
                            'spacing' => 'small',
                            'verticalContentAlignment' => 'center',
                            'items' => [
                                [
                                    'type' => 'TextBlock',
                                    'text' => 'Tony Harper',
                                    'wrap' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn...',
                    'targetWidth' => 'atLeast:Narrow',
                    'wrap' => true,
                    'id' => 'truncatedText',
                ],
                [
                    'type' => 'TextBlock',
                    'text' => 'This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn about design principles through hands-on projects that will help build your portfolio. Enroll now and start your journey to mastering the art of graphic design.',
                    'targetWidth' => 'atLeast:Narrow',
                    'wrap' => true,
                    'isVisible' => false,
                    'id' => 'fullText',
                ],
                [
                    'type' => 'RichTextBlock',
                    'id' => 'showMore',
                    'targetWidth' => 'atLeast:Narrow',
                    'spacing' => 'none',
                    'inlines' => [
                        [
                            'type' => 'TextRun',
                            'text' => 'Show more',
                            'selectAction' => [
                                'type' => 'Action.ToggleVisibility',
                                'targetElements' => [
                                    'truncatedText',
                                    'fullText',
                                    'showMore',
                                    'showLess',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'RichTextBlock',
                    'id' => 'showLess',
                    'targetWidth' => 'atLeast:Narrow',
                    'spacing' => 'none',
                    'isVisible' => false,
                    'inlines' => [
                        [
                            'type' => 'TextRun',
                            'text' => 'Show less',
                            'selectAction' => [
                                'type' => 'Action.ToggleVisibility',
                                'targetElements' => [
                                    'truncatedText',
                                    'fullText',
                                    'showMore',
                                    'showLess',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'ActionSet',
                    'spacing' => 'large',
                    'targetWidth' => 'atLeast:Narrow',
                    'actions' => [
                        [
                            'type' => 'Action.OpenUrl',
                            'title' => 'Open',
                            'url' => 'https://adaptivecards.io/',
                        ],
                        [
                            'type' => 'Action.Execute',
                            'title' => 'Bookmark',
                            'iconUrl' => 'icon:Bookmark',
                        ],
                    ],
                ],
                [
                    'type' => 'ActionSet',
                    'spacing' => 'large',
                    'targetWidth' => 'VeryNarrow',
                    'actions' => [
                        [
                            'type' => 'Action.OpenUrl',
                            'title' => 'Open',
                            'url' => 'https://adaptivecards.io/',
                        ],
                        [
                            'type' => 'Action.Execute',
                            'iconUrl' => 'icon:Bookmark',
                        ],
                    ],
                ],
            ],
        ];

        self::assertEquals($expected, $card->toArray());
    }
}
