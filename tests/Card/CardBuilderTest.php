<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\ExecuteAction;
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
use AdaptiveCards\Element\Rating;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\Table\Table;
use AdaptiveCards\Element\Table\TableCell;
use AdaptiveCards\Element\Table\TableColumnDefinition;
use AdaptiveCards\Element\Table\TableRow;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ActionMode;
use AdaptiveCards\Enum\ActionStyle;
use AdaptiveCards\Enum\ChoiceInputStyle;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\FontType;
use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;
use AdaptiveCards\Enum\ImageFillMode;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\ItemFit;
use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
use AdaptiveCards\Input\RatingInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\TimeInput;
use AdaptiveCards\Input\ToggleInput;
use AdaptiveCards\Layout\FlowLayout;
use AdaptiveCards\Shared\BackgroundImage;
use PHPUnit\Framework\TestCase;

final class CardBuilderTest extends TestCase
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

        $this->assertMatchesFixture($card, '1-fabricam-opportunity-status');
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
                $cs->column(Width::Auto, function (Column $c): void {
                    $c->verticalContentAlignment(VerticalAlignment::Center)
                        ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/author-highlight-video/assets/avatar.png', function (Image $img): void {
                            $img->width('24px')
                                ->height('24px')
                                ->style(ImageStyle::Person)
                                ->altText('Avatar of Kayo Miwa');
                        });
                })
                ->column(Width::Stretch, function (Column $c): void {
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
                $as->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Remind me')
                            ->iconUrl('icon:AlertUrgent')
                    );
            });

        $this->assertMatchesFixture($card, '2-author-video-3-minute-energy-flow');
    }

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

        $this->assertMatchesFixture($card, '3-social-post-hawaii-holiday-deals');
    }

    public function testBuildCourseVideoCard(): void
    {
        $toggleTargets = [
            TargetElement::make('truncatedText'),
            TargetElement::make('fullText'),
            TargetElement::make('showMore'),
            TargetElement::make('showLess'),
        ];

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Intro to graphic design, concepts video')
            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/video_image.png', function (Image $img): void {
                $img->selectAction(
                    OpenUrlAction::make('https://adaptivecards.io/')
                        ->tooltip('Intro to Graphic Design: Concepts Video')
                )->style(ImageStyle::RoundedCorners);
            })
            ->addTextBlock('Intro to Graphic Design: Concepts', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder);
            })
            ->addRating(4, 5, function (Rating $r): void {
                $r->count(1160)
                    ->color(RatingColor::Marigold)
                    ->size(RatingSize::Medium)
                    ->fallback(
                        TextBlock::make('4 Stars · 1,160')->spacing(Spacing::None)
                    )
                    ->spacing(Spacing::None);
            })
            ->addTextBlock('Course · 52m · Beginner', function (TextBlock $t): void {
                $t->wrap(true)
                    ->isSubtle(true)
                    ->spacing(Spacing::Small);
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::None)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->horizontalAlignment(HorizontalAlignment::Center)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/course-video/assets/logo_image.png', function (Image $img): void {
                                $img->width('16px')
                                    ->height('16px')
                                    ->altText('Logo');
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Sketchpad Scholars', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->weight(TextWeight::Bolder);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->targetWidth(TargetWidth::AtLeastStandard)
                            ->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('·');
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->targetWidth(TargetWidth::AtLeastStandard)
                            ->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Tony Harper', function (TextBlock $t): void {
                                $t->wrap(true);
                            });
                    });
            })
            ->addTextBlock('This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn...', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtLeastNarrow)
                    ->wrap(true)
                    ->id('truncatedText');
            })
            ->addTextBlock('This course is designed to equip you with an understanding of the key principles and tools necessary for creating compelling designs. You\'ll gain practical experience with creative software and learn about design principles through hands-on projects that will help build your portfolio. Enroll now and start your journey to mastering the art of graphic design.', function (TextBlock $t): void {
                $t->targetWidth(TargetWidth::AtLeastNarrow)
                    ->wrap(true)
                    ->isVisible(false)
                    ->id('fullText');
            })
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($toggleTargets): void {
                $rtb->id('showMore')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::None)
                    ->addInlines(
                        TextRun::make('Show more')
                            ->selectAction(
                                ToggleVisibilityAction::make()->targetElements($toggleTargets)
                            )
                    );
            })
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($toggleTargets): void {
                $rtb->id('showLess')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->spacing(Spacing::None)
                    ->isVisible(false)
                    ->addInlines(
                        TextRun::make('Show less')
                            ->selectAction(
                                ToggleVisibilityAction::make()->targetElements($toggleTargets)
                            )
                    );
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Large)
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(ExecuteAction::make('Bookmark')->iconUrl('icon:Bookmark'));
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->spacing(Spacing::Large)
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(ExecuteAction::make()->iconUrl('icon:Bookmark'));
            });

        $this->assertMatchesFixture($card, '4-course-video-intro-to-graphic-design');
    }

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

        $this->assertMatchesFixture($card, '5-issue-ssp-98-performance-optimization');
    }

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

        $this->assertMatchesFixture($card, '6-weekly-picks-learning-recommendations');
    }

    public function testBuildRecipeCard(): void
    {
        $imageUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Adaptive-Card-Samples/refs/heads/main/samples/recipe/assets/recipe_image.png';
        $recipeUrl = 'https://www.tasteofhome.com/recipes/spicy-apricot-glazed-chicken/';

        $firstParagraph = 'This sweet apricot-chile glazed broccoli recipe marries fruit and chiles to make this dish mouthwateringly special. Use organic jam in place of preserves for a smoother, prettier glaze if you are into spicy food, then this will be right up your alley.';
        $secondParagraph = "The recipe calls for 1/4 cup of the chili sauce which gives the chicken quite a bite on the palate. But for all you heat lovers, it's definitely a good feel.";
        $truncatedText = $firstParagraph . "\n\n" . $secondParagraph;

        $toggleTargets = [
            TargetElement::make('truncatedText'),
            TargetElement::make('fullText1'),
            TargetElement::make('fullText2'),
            TargetElement::make('showMore'),
            TargetElement::make('showLess'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Apricot-chile glazed chicken recipe')
            ->addImage($imageUrl, function (Image $img): void {
                $img->altText('Image of Apricot-Chile Glazed Chicken')
                    ->size(ImageSize::Stretch)
                    ->style(ImageStyle::RoundedCorners);
            })
            ->addTextBlock('Apricot-Chile Glazed Chicken', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder)
                    ->color(Colors::Default);
            })
            ->addTextBlock('15 min · 215 calories · 29g protein', function (TextBlock $t): void {
                $t->wrap(true)
                    ->spacing(Spacing::None)
                    ->fontType(FontType::Default)
                    ->size(TextSize::Small)
                    ->weight(TextWeight::Default)
                    ->isSubtle(true)
                    ->color(Colors::Default);
            })
            ->addTextBlock($truncatedText, function (TextBlock $t): void {
                $t->id('truncatedText')
                    ->wrap(true)
                    ->maxLines(3);
            })
            ->addTextBlock($firstParagraph, function (TextBlock $t): void {
                $t->id('fullText1')
                    ->wrap(true)
                    ->isVisible(false);
            })
            ->addTextBlock($secondParagraph, function (TextBlock $t): void {
                $t->id('fullText2')
                    ->wrap(true)
                    ->isVisible(false);
            })
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                $rtb->id('showMore')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addInlines(
                        TextRun::make('Show more')
                            ->selectAction($createToggleAction())
                    );
            })
            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                $rtb->id('showLess')
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->isVisible(false)
                    ->addInlines(
                        TextRun::make('Show less')
                            ->selectAction($createToggleAction())
                    );
            })
            ->addActionSet(function (ActionSet $as) use ($recipeUrl): void {
                $as->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addActions(OpenUrlAction::make($recipeUrl, 'View recipe'))
                    ->addActions(
                        SubmitAction::make('Add to cart')
                            ->iconUrl('icon:Cart')
                    )
                    ->spacing(Spacing::Medium);
            })
            ->addActionSet(function (ActionSet $as) use ($recipeUrl): void {
                $as->targetWidth(TargetWidth::VeryNarrow)
                    ->addActions(OpenUrlAction::make($recipeUrl, 'View recipe'))
                    ->addActions(
                        SubmitAction::make()
                            ->iconUrl('icon:Cart')
                    )
                    ->spacing(Spacing::Medium);
            });

        $this->assertMatchesFixture($card, '7-recipe-apricot-chile-glazed-chicken');
    }

    public function testBuildWebDevelopmentBootcampVideoCard(): void
    {
        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->speak('Web development bootcamp video')
            ->addImage('https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Card-Samples/main/samples/standard-video/assets/video_image.png', function (Image $img): void {
                $img->altText('Web Development Bootcamp Video')
                    ->style(ImageStyle::RoundedCorners);
            })
            ->addTextBlock('Web Development Bootcamp', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder);
            })
            ->addTextBlock('HackLab Films', function (TextBlock $t): void {
                $t->wrap(true)
                    ->spacing(Spacing::Small)
                    ->weight(TextWeight::Bolder);
            })
            ->addTextBlock('24m · 17.1M views · 2 months ago', function (TextBlock $t): void {
                $t->wrap(true)
                    ->spacing(Spacing::None);
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Add to calendar')
                            ->iconUrl('icon:Calendar')
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Share in Teams')
                            ->mode(ActionMode::Secondary)
                            ->iconUrl('icon:PeopleTeam')
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Download')
                            ->mode(ActionMode::Secondary)
                            ->iconUrl('icon:ArrowDown')
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Copy link')
                            ->mode(ActionMode::Secondary)
                            ->iconUrl('icon:Link')
                    );
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->targetWidth(TargetWidth::VeryNarrow)
                    ->addActions(OpenUrlAction::make('https://adaptivecards.io/', 'Open'))
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/')
                            ->iconUrl('icon:Calendar')
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Share in Teams')
                            ->iconUrl('icon:PeopleTeam')
                            ->mode(ActionMode::Secondary)
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Download')
                            ->iconUrl('icon:ArrowDown')
                            ->mode(ActionMode::Secondary)
                    )
                    ->addActions(
                        OpenUrlAction::make('https://adaptivecards.io/', 'Copy link')
                            ->iconUrl('icon:Link')
                            ->mode(ActionMode::Secondary)
                    );
            });

        $this->assertMatchesFixture($card, '8-video-web-development-bootcamp');
    }

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

        $this->assertMatchesFixture($card, '9-bug-2837-dark-mode-icons');
    }

    public function testBuildTimeOffRequestCard(): void
    {
        $toggleTargets = [
            TargetElement::make('vNarrowBalance'),
            TargetElement::make('balanceDown'),
            TargetElement::make('balanceUp'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $commentToggleTargets = [
            TargetElement::make('comments'),
            TargetElement::make('chevronUp'),
            TargetElement::make('chevronDown'),
        ];

        $createCommentToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($commentToggleTargets);

        $heroImageUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Adaptive-Card-Samples/main/samples/time-off-request/assets/hero-image-default.png';
        $heroWideImageUrl = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Adaptive-Card-Samples/main/samples/time-off-request/assets/hero-wide.png';

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->addTextBlock('Time off request', function (TextBlock $t): void {
                $t->wrap(true)
                    ->size(TextSize::Large)
                    ->weight(TextWeight::Bolder)
                    ->spacing(Spacing::None);
            })
            ->addImage($heroImageUrl, function (Image $img): void {
                $img->style(ImageStyle::RoundedCorners)
                    ->targetWidth(TargetWidth::AtMostStandard);
            })
            ->addImage($heroWideImageUrl, function (Image $img): void {
                $img->targetWidth(TargetWidth::Wide)
                    ->style(ImageStyle::RoundedCorners);
            })
            ->addTextBlock('Current balance', function (TextBlock $t): void {
                $t->wrap(true)
                    ->weight(TextWeight::Bolder)
                    ->color(Colors::Accent)
                    ->targetWidth(TargetWidth::AtLeastNarrow);
            })
            ->addContainer(function (Container $cont): void {
                $cont->style(ContainerStyle::Accent)
                    ->showBorder(true)
                    ->roundedCorners(true)
                    ->spacing(Spacing::ExtraSmall)
                    ->targetWidth(TargetWidth::Wide)
                    ->horizontalAlignment(HorizontalAlignment::Center)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Stretch, function (Column $c): void {
                            $c->addTextBlock('24h', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->color(Colors::Accent)
                                    ->size(TextSize::ExtraLarge)
                                    ->weight(TextWeight::Bolder);
                            })
                            ->addColumnSet(function (ColumnSet $innerCs): void {
                                $innerCs->spacing(Spacing::ExtraSmall)
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->addIcon('HeartPulse', function (Icon $i): void {
                                            $i->color(Colors::Accent)
                                                ->size(IconSize::XSmall);
                                        });
                                    })
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->spacing(Spacing::ExtraSmall)
                                            ->addTextBlock('Sick Days', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder)
                                                    ->size(TextSize::Default);
                                            });
                                    });
                            })
                            ->addTextBlock('Accrued at eight hours per three months.', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->spacing(Spacing::ExtraSmall);
                            });
                        })
                        ->column(Width::Stretch, function (Column $c): void {
                            $c->spacing(Spacing::ExtraLarge)
                                ->addTextBlock('12h', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->color(Colors::Accent)
                                        ->size(TextSize::ExtraLarge)
                                        ->weight(TextWeight::Bolder);
                                })
                                ->addColumnSet(function (ColumnSet $innerCs): void {
                                    $innerCs->spacing(Spacing::ExtraSmall)
                                        ->column(Width::Auto, function (Column $col): void {
                                            $col->addIcon('LeafOne', function (Icon $i): void {
                                                $i->color(Colors::Accent)
                                                    ->size(IconSize::XSmall);
                                            });
                                        })
                                        ->column(Width::Auto, function (Column $col): void {
                                            $col->spacing(Spacing::ExtraSmall)
                                                ->addTextBlock('Wellness', function (TextBlock $t): void {
                                                    $t->wrap(true)
                                                        ->weight(TextWeight::Bolder);
                                                });
                                        });
                                })
                                ->addTextBlock('One time 5 day affordance for the year', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->isSubtle(true)
                                        ->size(TextSize::Small)
                                        ->spacing(Spacing::ExtraSmall);
                                });
                        })
                        ->column(Width::Stretch, function (Column $c): void {
                            $c->spacing(Spacing::ExtraLarge)
                                ->addTextBlock('32h', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->color(Colors::Accent)
                                        ->size(TextSize::ExtraLarge)
                                        ->weight(TextWeight::Bolder);
                                })
                                ->addColumnSet(function (ColumnSet $innerCs): void {
                                    $innerCs->spacing(Spacing::ExtraSmall)
                                        ->column(Width::Auto, function (Column $col): void {
                                            $col->addIcon('Beach', function (Icon $i): void {
                                                $i->color(Colors::Accent)
                                                    ->size(IconSize::XSmall);
                                            });
                                        })
                                        ->column(Width::Auto, function (Column $col): void {
                                            $col->spacing(Spacing::ExtraSmall)
                                                ->addTextBlock('Paid time off', function (TextBlock $t): void {
                                                    $t->wrap(true)
                                                        ->weight(TextWeight::Bolder);
                                                });
                                        });
                                })
                                ->addTextBlock('Accrued at eight hours per one month.', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->isSubtle(true)
                                        ->size(TextSize::Small)
                                        ->spacing(Spacing::ExtraSmall);
                                });
                        });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->style(ContainerStyle::Accent)
                    ->showBorder(true)
                    ->roundedCorners(true)
                    ->spacing(Spacing::ExtraSmall)
                    ->targetWidth(TargetWidth::Standard)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Auto, function (Column $c): void {
                            $c->addTextBlock('24h', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->color(Colors::Accent)
                                    ->size(TextSize::ExtraLarge)
                                    ->weight(TextWeight::Bolder);
                            })
                            ->addColumnSet(function (ColumnSet $innerCs): void {
                                $innerCs->spacing(Spacing::ExtraSmall)
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->addIcon('HeartPulse', function (Icon $i): void {
                                            $i->color(Colors::Accent)
                                                ->size(IconSize::XSmall);
                                        });
                                    })
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->spacing(Spacing::ExtraSmall)
                                            ->addTextBlock('Sick Days', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder);
                                            });
                                    });
                            })
                            ->addTextBlock('Accrued at eight hours per three months.', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->spacing(Spacing::ExtraSmall);
                            });
                        })
                        ->column(Width::Auto, function (Column $c): void {
                            $c->addTextBlock('12h', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->color(Colors::Accent)
                                    ->size(TextSize::ExtraLarge)
                                    ->weight(TextWeight::Bolder);
                            })
                            ->addColumnSet(function (ColumnSet $innerCs): void {
                                $innerCs->spacing(Spacing::ExtraSmall)
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->addIcon('LeafOne', function (Icon $i): void {
                                            $i->color(Colors::Accent)
                                                ->size(IconSize::XSmall);
                                        });
                                    })
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->spacing(Spacing::ExtraSmall)
                                            ->addTextBlock('Wellness', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder);
                                            });
                                    });
                            })
                            ->addTextBlock('One time 5 day affordance for the year', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->spacing(Spacing::ExtraSmall);
                            });
                        })
                        ->column(Width::Auto, function (Column $c): void {
                            $c->addTextBlock('32h', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->color(Colors::Accent)
                                    ->size(TextSize::ExtraLarge)
                                    ->weight(TextWeight::Bolder);
                            })
                            ->addColumnSet(function (ColumnSet $innerCs): void {
                                $innerCs->spacing(Spacing::ExtraSmall)
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->addIcon('Beach', function (Icon $i): void {
                                            $i->color(Colors::Accent)
                                                ->size(IconSize::XSmall);
                                        });
                                    })
                                    ->column(Width::Auto, function (Column $col): void {
                                        $col->spacing(Spacing::ExtraSmall)
                                            ->addTextBlock('Paid time off', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->weight(TextWeight::Bolder);
                                            });
                                    });
                            })
                            ->addTextBlock('Accrued at eight hours per one month.', function (TextBlock $t): void {
                                $t->wrap(true)
                                    ->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->spacing(Spacing::ExtraSmall);
                            });
                        });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->style(ContainerStyle::Accent)
                    ->showBorder(true)
                    ->roundedCorners(true)
                    ->spacing(Spacing::ExtraSmall)
                    ->targetWidth(TargetWidth::Narrow)
                    ->horizontalAlignment(HorizontalAlignment::Center)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Stretch, function (Column $c): void {
                            $c->horizontalAlignment(HorizontalAlignment::Center)
                                ->addIcon('HeartPulse', function (Icon $i): void {
                                    $i->color(Colors::Accent)
                                        ->horizontalAlignment(HorizontalAlignment::Center)
                                        ->size(IconSize::Small);
                                })
                                ->addTextBlock('24h', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->size(TextSize::Large)
                                        ->color(Colors::Accent)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None);
                                })
                                ->addTextBlock('Sick days', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None)
                                        ->size(TextSize::Small)
                                        ->color(Colors::Default);
                                });
                        })
                        ->column(Width::Stretch, function (Column $c): void {
                            $c->horizontalAlignment(HorizontalAlignment::Center)
                                ->addIcon('LeafOne', function (Icon $i): void {
                                    $i->color(Colors::Accent)
                                        ->horizontalAlignment(HorizontalAlignment::Center)
                                        ->size(IconSize::Small);
                                })
                                ->addTextBlock('12h', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->size(TextSize::Large)
                                        ->color(Colors::Accent)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None);
                                })
                                ->addTextBlock('Wellness', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None)
                                        ->size(TextSize::Small)
                                        ->color(Colors::Default);
                                });
                        })
                        ->column(Width::Stretch, function (Column $c): void {
                            $c->horizontalAlignment(HorizontalAlignment::Center)
                                ->addIcon('Beach', function (Icon $i): void {
                                    $i->horizontalAlignment(HorizontalAlignment::Center)
                                        ->color(Colors::Accent)
                                        ->size(IconSize::Small);
                                })
                                ->addTextBlock('32h', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->color(Colors::Accent)
                                        ->size(TextSize::Large)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None);
                                })
                                ->addTextBlock('Paid time off', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->weight(TextWeight::Bolder)
                                        ->spacing(Spacing::None)
                                        ->size(TextSize::Small)
                                        ->color(Colors::Default);
                                });
                        });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->targetWidth(TargetWidth::VeryNarrow)
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                            $rtb->addInlines(
                                TextRun::make('View current balance')
                                    ->selectAction($createToggleAction())
                            );
                        });
                    })
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Bottom)
                            ->spacing(Spacing::ExtraSmall)
                            ->addIcon('ChevronDown', function (Icon $i) use ($createToggleAction): void {
                                $i->size(IconSize::XxSmall)
                                    ->selectAction($createToggleAction())
                                    ->color(Colors::Accent)
                                    ->id('balanceDown');
                            })
                            ->addIcon('ChevronUp', function (Icon $i) use ($createToggleAction): void {
                                $i->isVisible(false)
                                    ->id('balanceUp')
                                    ->size(IconSize::XxSmall)
                                    ->color(Colors::Accent)
                                    ->selectAction($createToggleAction());
                            });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->style(ContainerStyle::Accent)
                    ->bleed(true)
                    ->spacing(Spacing::Small)
                    ->isVisible(false)
                    ->id('vNarrowBalance')
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->horizontalAlignment(HorizontalAlignment::Left)
                            ->column('40px', function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('24h', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->size(TextSize::Large)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Accent);
                                    });
                            })
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::Small)
                                    ->addIcon('HeartPulse', function (Icon $i): void {
                                        $i->color(Colors::Accent)
                                            ->size(IconSize::XSmall);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::ExtraSmall)
                                    ->addTextBlock('Sick days', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->size(TextSize::Small)
                                            ->color(Colors::Default);
                                    });
                            });
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::ExtraSmall)
                            ->column('40px', function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('12h', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Accent)
                                            ->size(TextSize::Large);
                                    });
                            })
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::Small)
                                    ->addIcon('LeafOne', function (Icon $i): void {
                                        $i->color(Colors::Accent)
                                            ->size(IconSize::XSmall);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::ExtraSmall)
                                    ->addTextBlock('Wellness', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->size(TextSize::Small)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Default);
                                    });
                            });
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::ExtraSmall)
                            ->column('40px', function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->addTextBlock('32h', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Accent)
                                            ->size(TextSize::Large);
                                    });
                            })
                            ->column(Width::Auto, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::Small)
                                    ->addIcon('Beach', function (Icon $i): void {
                                        $i->color(Colors::Accent)
                                            ->size(IconSize::XSmall);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->verticalContentAlignment(VerticalAlignment::Center)
                                    ->spacing(Spacing::ExtraSmall)
                                    ->addTextBlock('Paid time off', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->size(TextSize::Small)
                                            ->weight(TextWeight::Bolder)
                                            ->color(Colors::Default);
                                    });
                            });
                    });
            })
            ->addChoiceSetInput('leave_reason', function (ChoiceSetInput $input): void {
                $input->label('Reason for leave')
                    ->choice('Vacation', 'Vacation')
                    ->choice('Sick Day', 'Sick Day')
                    ->choice('Sick Leave', 'Sick Leave')
                    ->choice('Other', 'Other')
                    ->value('Vacation')
                    ->spacing(Spacing::Medium);
            })
            ->addToggleInput('all_day', 'All day (8hrs)', function (ToggleInput $input): void {
                $input->spacing(Spacing::Small);
            })
            ->addContainer(function (Container $cont): void {
                $cont->addFlowLayout(function (FlowLayout $layout): void {
                    $layout->verticalItemsAlignment(VerticalAlignment::Bottom)
                        ->minItemWidth('0px')
                        ->itemFit(ItemFit::Fill);
                })
                ->addDateInput('date', 'Date', function (DateInput $input): void {
                    $input->isRequired(true)
                        ->errorMessage('Date is required');
                });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->column(Width::Stretch)
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Bottom);
                    });
            })
            ->addNumberInput('days_off', 'Estimated days off', 'Select how many days', function (NumberInput $input): void {
                $input->spacing(Spacing::Medium);
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createCommentToggleAction): void {
                $cs->spacing(Spacing::Medium)
                    ->column(Width::Auto, function (Column $c) use ($createCommentToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createCommentToggleAction): void {
                                $rtb->targetWidth(TargetWidth::AtLeastNarrow)
                                    ->addInlines(
                                        TextRun::make('Add comments')
                                            ->selectAction($createCommentToggleAction())
                                    );
                            });
                    })
                    ->column(Width::Auto, function (Column $c) use ($createCommentToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->spacing(Spacing::Small)
                            ->selectAction($createCommentToggleAction())
                            ->addIcon('ChevronDown', function (Icon $i): void {
                                $i->color(Colors::Accent)
                                    ->id('chevronDown')
                                    ->size(IconSize::XxSmall);
                            })
                            ->addIcon('ChevronUp', function (Icon $i): void {
                                $i->color(Colors::Accent)
                                    ->id('chevronUp')
                                    ->isVisible(false)
                                    ->size(IconSize::XxSmall)
                                    ->spacing(Spacing::None);
                            });
                    });
            })
            ->addTextInput('comments', null, 'Enter any comments', function (TextInput $input): void {
                $input->isVisible(false)
                    ->isMultiline(true);
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->separator(true)
                    ->spacing(Spacing::ExtraLarge)
                    ->addActions(
                        SubmitAction::make('Submit')
                            ->style(ActionStyle::Positive)
                    );
            });

        $this->assertMatchesFixture($card, '10-time-off-request-form');
    }

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

        $this->assertMatchesFixture($card, '11-expense-report-travel-to-seattle-approved');
    }

    public function testBuildBookARoomCard(): void
    {
        $toggleTargets = [
            TargetElement::make('notes'),
            TargetElement::make('chevronUp'),
            TargetElement::make('chevronDown'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $heroUrl = 'https://raw.githubusercontent.com/suzto/StarterCards/refs/heads/main/samples/book-a-room/assets/room_hero.png';

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->addContainer(function (Container $cont) use ($heroUrl): void {
                $cont->style(ContainerStyle::Emphasis)
                    ->targetWidth(TargetWidth::AtLeastStandard)
                    ->minHeight('200px')
                    ->roundedCorners(true)
                    ->verticalContentAlignment(VerticalAlignment::Bottom)
                    ->backgroundImage(BackgroundImage::make($heroUrl)->verticalAlignment(VerticalAlignment::Bottom))
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->targetWidth(TargetWidth::AtLeastStandard)
                            ->column(Width::Stretch)
                            ->column('190px', function (Column $c): void {
                                $c->addContainer(function (Container $innerCont): void {
                                    $innerCont->roundedCorners(true)
                                        ->style(ContainerStyle::Default)
                                        ->addTextBlock('Book a private meeting room', function (TextBlock $t): void {
                                            $t->maxLines(0)
                                                ->size(TextSize::ExtraLarge)
                                                ->weight(TextWeight::Bolder)
                                                ->wrap(true);
                                        });
                                });
                            });
                    });
            })
            ->addContainer(function (Container $cont) use ($heroUrl): void {
                $cont->style(ContainerStyle::Emphasis)
                    ->targetWidth(TargetWidth::Narrow)
                    ->minHeight('140px')
                    ->roundedCorners(true)
                    ->verticalContentAlignment(VerticalAlignment::Bottom)
                    ->backgroundImage(BackgroundImage::make($heroUrl)->verticalAlignment(VerticalAlignment::Bottom))
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->column(Width::Stretch)
                            ->column('150px');
                    });
            })
            ->addImage($heroUrl, function (Image $img): void {
                $img->style(ImageStyle::RoundedCorners)
                    ->targetWidth(TargetWidth::VeryNarrow);
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::Medium)
                    ->targetWidth(TargetWidth::AtMostNarrow)
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->addTextBlock('The Rooftop Terrace', function (TextBlock $t): void {
                            $t->wrap(true)
                                ->weight(TextWeight::Bolder)
                                ->color(Colors::Accent);
                        })
                        ->addColumnSet(function (ColumnSet $innerCs): void {
                            $innerCs->spacing(Spacing::ExtraSmall)
                                ->column(Width::Auto, function (Column $col): void {
                                    $col->addIcon('Crown', function (Icon $i): void {
                                        $i->size(IconSize::XxSmall)
                                            ->color(Colors::Accent);
                                    });
                                })
                                ->column(Width::Stretch, function (Column $col): void {
                                    $col->spacing(Spacing::ExtraSmall)
                                        ->addTextBlock('Executive suite', function (TextBlock $t): void {
                                            $t->wrap(true)
                                                ->size(TextSize::Small)
                                                ->color(Colors::Default)
                                                ->isSubtle(true);
                                        });
                                });
                        });
                    });
            })
            ->addColumnSet(function (ColumnSet $cs): void {
                $cs->spacing(Spacing::Medium)
                    ->targetWidth(TargetWidth::AtLeastStandard)
                    ->column(Width::Auto, function (Column $c): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('The Rooftop Terrace ', function (TextBlock $t): void {
                                $t->color(Colors::Accent)
                                    ->weight(TextWeight::Bolder)
                                    ->wrap(true);
                            });
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->targetWidth(TargetWidth::AtLeastNarrow)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('·');
                    })
                    ->column(Width::Auto, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->targetWidth(TargetWidth::AtLeastNarrow)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addIcon('Crown', function (Icon $i): void {
                                $i->color(Colors::Accent)
                                    ->size(IconSize::XxSmall);
                            });
                    })
                    ->column(Width::Stretch, function (Column $c): void {
                        $c->spacing(Spacing::Small)
                            ->targetWidth(TargetWidth::AtLeastNarrow)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->addTextBlock('Executive suite', function (TextBlock $t): void {
                                $t->isSubtle(true)
                                    ->size(TextSize::Small)
                                    ->wrap(true);
                            });
                    });
            })
            ->addContainer(function (Container $cont): void {
                $cont->spacing(Spacing::Medium)
                    ->addDateInput('date', 'Start Date', function (DateInput $input): void {
                        $input->errorMessage('Start date is required')
                            ->isRequired(true);
                    })
                    ->addTimeInput('time', 'Start Time', function (TimeInput $input): void {
                        $input->errorMessage('Start time is required')
                            ->isRequired(true);
                    })
                    ->addFlowLayout(function (FlowLayout $layout): void {
                        $layout->columnSpacing(Spacing::Small)
                            ->itemFit(ItemFit::Fill)
                            ->minItemWidth('0px')
                            ->rowSpacing(Spacing::Small);
                    });
            })
            ->addChoiceSetInput('duration', function (ChoiceSetInput $input): void {
                $input->label('Duration')
                    ->spacing(Spacing::Medium)
                    ->isRequired(true)
                    ->errorMessage('Duration is required')
                    ->value('1')
                    ->choice('1 Hour', '1')
                    ->choice('2 Hours', '2')
                    ->choice('3 Hours', '3');
            })
            ->addTextInput('title', 'Meeting or event title', 'Enter optional title', function (TextInput $input): void {
                $input->spacing(Spacing::Medium);
            })
            ->addChoiceSetInput('catering', function (ChoiceSetInput $input): void {
                $input->label('Select a catering option')
                    ->spacing(Spacing::Medium)
                    ->style(ChoiceInputStyle::Expanded)
                    ->choice('Lunch buffet', 'value1')
                    ->choice('Dinner with appetizers', 'value2');
            })
            ->addRatingInput('rating', 'Rate importance of having catering services', function (RatingInput $input): void {
                $input->color(RatingColor::Marigold)
                    ->spacing(Spacing::Small);
            })
            ->addColumnSet(function (ColumnSet $cs) use ($createToggleAction): void {
                $cs->spacing(Spacing::Medium)
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->verticalContentAlignment(VerticalAlignment::Center)
                            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                $rtb->targetWidth(TargetWidth::AtLeastNarrow)
                                    ->addInlines(
                                        TextRun::make('Add notes or requests')
                                            ->selectAction($createToggleAction())
                                    );
                            })
                            ->addRichTextBlock(function (RichTextBlock $rtb) use ($createToggleAction): void {
                                $rtb->spacing(Spacing::None)
                                    ->targetWidth(TargetWidth::VeryNarrow)
                                    ->addInlines(
                                        TextRun::make('Additional options')
                                            ->selectAction($createToggleAction())
                                    );
                            });
                    })
                    ->column(Width::Auto, function (Column $c) use ($createToggleAction): void {
                        $c->spacing(Spacing::Small)
                            ->verticalContentAlignment(VerticalAlignment::Center)
                            ->selectAction($createToggleAction())
                            ->addIcon('ChevronDown', function (Icon $i): void {
                                $i->color(Colors::Accent)
                                    ->id('chevronDown')
                                    ->size(IconSize::XxSmall);
                            })
                            ->addIcon('ChevronUp', function (Icon $i): void {
                                $i->color(Colors::Accent)
                                    ->id('chevronUp')
                                    ->isVisible(false)
                                    ->size(IconSize::XxSmall)
                                    ->spacing(Spacing::None);
                            });
                    });
            })
            ->addTextInput('notes', null, 'Enter any additional notes or requests', function (TextInput $input): void {
                $input->isMultiline(true)
                    ->isVisible(false)
                    ->spacing(Spacing::Small);
            })
            ->addActionSet(function (ActionSet $as): void {
                $as->separator(true)
                    ->spacing(Spacing::Medium)
                    ->addActions(SubmitAction::make('Submit')->style(ActionStyle::Positive));
            });

        $this->assertMatchesFixture($card, '12-meeting-room-booking-form');
    }

    public function testBuildCafeMenuCard(): void
    {
        $toggleTargets = [
            TargetElement::make('menu'),
            TargetElement::make('info'),
        ];

        $createToggleAction = static fn (): ToggleVisibilityAction =>
            ToggleVisibilityAction::make()->targetElements($toggleTargets);

        $assets = 'https://raw.githubusercontent.com/OfficeDev/Microsoft-Teams-Adaptive-Card-Samples/main/samples/cafe-menu/assets/';

        $card = AdaptiveCard::make('1.6')
            ->schema('https://adaptivecards.io/schemas/adaptive-card.json')
            ->addContainer(function (Container $cont) use ($assets): void {
                $cont->roundedCorners(true)
                    ->backgroundImage(BackgroundImage::make($assets . 'hero.png'))
                    ->minHeight('160px')
                    ->verticalContentAlignment(VerticalAlignment::Bottom)
                    ->targetWidth(TargetWidth::AtLeastNarrow)
                    ->addTextBlock('Cafeteria 24', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->size(TextSize::ExtraLarge)
                            ->weight(TextWeight::Bolder)
                            ->color(Colors::Light);
                    });
            })
            ->addContainer(function (Container $cont) use ($assets): void {
                $cont->backgroundImage(
                    BackgroundImage::make($assets . 'hero.png')
                        ->verticalAlignment(VerticalAlignment::Center)
                )
                    ->verticalContentAlignment(VerticalAlignment::Bottom)
                    ->minHeight('120px')
                    ->roundedCorners(true)
                    ->targetWidth(TargetWidth::VeryNarrow)
                    ->addTextBlock('Cafeteria 24', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->size(TextSize::ExtraLarge)
                            ->weight(TextWeight::Bolder)
                            ->color(Colors::Light);
                    });
            })
            ->addContainer(function (Container $cont) use ($assets, $createToggleAction): void {
                $cont->id('menu')
                    ->spacing(Spacing::Large)
                    ->addContainer(function (Container $tabs) use ($assets, $createToggleAction): void {
                        $tabs->addColumnSet(function (ColumnSet $cs) use ($assets, $createToggleAction): void {
                            $cs->spacing(Spacing::Large)
                                ->column(Width::Stretch, function (Column $c) use ($assets): void {
                                    $c->addTextBlock('Menu', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->horizontalAlignment(HorizontalAlignment::Center);
                                    })
                                    ->addContainer(function (Container $line) use ($assets): void {
                                        $line->backgroundImage(
                                            BackgroundImage::make($assets . 'tabline.png')
                                                ->fillMode(ImageFillMode::RepeatHorizontally)
                                                ->verticalAlignment(VerticalAlignment::Center)
                                        )
                                            ->minHeight('3px')
                                            ->style(ContainerStyle::Default)
                                            ->spacing(Spacing::None);
                                    });
                                })
                                ->column(Width::Stretch, function (Column $c) use ($createToggleAction): void {
                                    $c->selectAction($createToggleAction())
                                        ->addTextBlock('Info', function (TextBlock $t): void {
                                            $t->wrap(true)
                                                ->horizontalAlignment(HorizontalAlignment::Center);
                                        });
                                });
                        });
                    })
                    ->addTextBlock("Today's Specials", function (TextBlock $t): void {
                        $t->wrap(true)
                            ->size(TextSize::Small)
                            ->weight(TextWeight::Bolder)
                            ->isSubtle(true)
                            ->spacing(Spacing::Medium);
                    })
                    ->addContainer(function (Container $item) use ($assets): void {
                        $item->style(ContainerStyle::Emphasis)
                            ->showBorder(true)
                            ->roundedCorners(true)
                            ->spacing(Spacing::Small)
                            ->addColumnSet(function (ColumnSet $cs) use ($assets): void {
                                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                                    ->column('80px', function (Column $c) use ($assets): void {
                                        $c->minHeight('80px')
                                            ->addImage($assets . 'menuItem_1.png', function (Image $img): void {
                                                $img->style(ImageStyle::RoundedCorners)
                                                    ->width('80px')
                                                    ->height('80px');
                                            });
                                    })
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->addTextBlock('Korean Fried Chicken', function (TextBlock $t): void {
                                            $t->wrap(true)
                                                ->weight(TextWeight::Bolder);
                                        })
                                            ->addTextBlock('Boneless Korean gochujhang or sweet garlic fried chicken over your choice of rice.', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::None);
                                            })
                                            ->addTextBlock('• Organic', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::None);
                                            })
                                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                                $rtb->spacing(Spacing::None)
                                                    ->inlines(
                                                        TextRun::make('• Farm to table - '),
                                                        TextRun::make('Harvest Moon Farm')
                                                            ->italic(true)
                                                            ->color(Colors::Accent)
                                                    );
                                            })
                                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                                $rtb->spacing(Spacing::None)
                                                    ->inlines(
                                                        TextRun::make('$12.00')
                                                            ->color(Colors::Attention)
                                                            ->strikethrough(true),
                                                        TextRun::make('  $10.99')
                                                            ->isSubtle(true)
                                                    );
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->verticalContentAlignment(VerticalAlignment::Center)
                                            ->spacing(Spacing::ExtraSmall)
                                            ->addIcon('ChevronRight', function (Icon $i): void {
                                                $i->size(IconSize::Small);
                                            });
                                    });
                            })
                            ->addContainer(function (Container $narrow) use ($assets): void {
                                $narrow->spacing(Spacing::None)
                                    ->targetWidth(TargetWidth::VeryNarrow)
                                    ->horizontalAlignment(HorizontalAlignment::Center)
                                    ->addImage($assets . 'menuItem_1.png', function (Image $img): void {
                                        $img->width('64px')
                                            ->height('64px')
                                            ->style(ImageStyle::RoundedCorners);
                                    })
                                    ->addTextBlock('Korean Fried Chicken', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->spacing(Spacing::Small);
                                    })
                                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                        $rtb->spacing(Spacing::None)
                                            ->inlines(
                                                TextRun::make('$12.00')
                                                    ->color(Colors::Attention)
                                                    ->strikethrough(true),
                                                TextRun::make('  $10.99')
                                                    ->isSubtle(true)
                                            );
                                    });
                            });
                    })
                    ->addContainer(function (Container $item) use ($assets): void {
                        $item->style(ContainerStyle::Emphasis)
                            ->showBorder(true)
                            ->roundedCorners(true)
                            ->spacing(Spacing::Small)
                            ->addColumnSet(function (ColumnSet $cs) use ($assets): void {
                                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                                    ->column('80px', function (Column $c) use ($assets): void {
                                        $c->minHeight('80px')
                                            ->addImage($assets . 'menuItem_2.png', function (Image $img): void {
                                                $img->style(ImageStyle::RoundedCorners)
                                                    ->width('80px')
                                                    ->height('80px');
                                            });
                                    })
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->addTextBlock('Bibimbap', function (TextBlock $t): void {
                                            $t->wrap(true)
                                                ->weight(TextWeight::Bolder);
                                        })
                                            ->addTextBlock('Korean rice bowl with your choice of protein, vegetable toppings, egg and your choice of sauce.', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::None);
                                            })
                                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                                $rtb->spacing(Spacing::None)
                                                    ->inlines(
                                                        TextRun::make('$13.00')
                                                            ->color(Colors::Attention)
                                                            ->strikethrough(true),
                                                        TextRun::make('  $12.00')
                                                            ->isSubtle(true)
                                                    );
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->verticalContentAlignment(VerticalAlignment::Center)
                                            ->spacing(Spacing::ExtraSmall)
                                            ->addIcon('ChevronRight', function (Icon $i): void {
                                                $i->size(IconSize::Small);
                                            });
                                    });
                            })
                            ->addContainer(function (Container $narrow) use ($assets): void {
                                $narrow->spacing(Spacing::None)
                                    ->targetWidth(TargetWidth::VeryNarrow)
                                    ->horizontalAlignment(HorizontalAlignment::Center)
                                    ->addImage($assets . 'menuItem_2.png', function (Image $img): void {
                                        $img->width('64px')
                                            ->height('64px')
                                            ->style(ImageStyle::RoundedCorners);
                                    })
                                    ->addTextBlock('Bibimbap', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->spacing(Spacing::Small);
                                    })
                                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                        $rtb->spacing(Spacing::None)
                                            ->inlines(
                                                TextRun::make('$13.00')
                                                    ->color(Colors::Attention)
                                                    ->strikethrough(true),
                                                TextRun::make('  $12.00')
                                                    ->isSubtle(true)
                                            );
                                    });
                            });
                    })
                    ->addContainer(function (Container $item) use ($assets): void {
                        $item->style(ContainerStyle::Emphasis)
                            ->showBorder(true)
                            ->roundedCorners(true)
                            ->spacing(Spacing::Small)
                            ->addColumnSet(function (ColumnSet $cs) use ($assets): void {
                                $cs->targetWidth(TargetWidth::AtLeastNarrow)
                                    ->column('80px', function (Column $c) use ($assets): void {
                                        $c->minHeight('80px')
                                            ->addImage($assets . 'menuItem_3.png', function (Image $img): void {
                                                $img->style(ImageStyle::RoundedCorners)
                                                    ->width('80px')
                                                    ->height('80px');
                                            });
                                    })
                                    ->column(Width::Stretch, function (Column $c): void {
                                        $c->addTextBlock('Japchae Noodle Bowl', function (TextBlock $t): void {
                                            $t->wrap(true)
                                                ->weight(TextWeight::Bolder);
                                        })
                                            ->addTextBlock('Vermicelli noodles pan fried with a variety of vegetables with a sweet soy sauce.', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::None);
                                            })
                                            ->addTextBlock('• Vegan', function (TextBlock $t): void {
                                                $t->wrap(true)
                                                    ->spacing(Spacing::None);
                                            })
                                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                                $rtb->spacing(Spacing::None)
                                                    ->inlines(
                                                        TextRun::make('• Local made - '),
                                                        TextRun::make('Hikari Ramen House')
                                                            ->italic(true)
                                                            ->color(Colors::Accent)
                                                    );
                                            })
                                            ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                                $rtb->spacing(Spacing::None)
                                                    ->inlines(
                                                        TextRun::make('$14.00')
                                                            ->color(Colors::Attention)
                                                            ->strikethrough(true),
                                                        TextRun::make('  $11.99')
                                                            ->isSubtle(true)
                                                    );
                                            });
                                    })
                                    ->column(Width::Auto, function (Column $c): void {
                                        $c->verticalContentAlignment(VerticalAlignment::Center)
                                            ->spacing(Spacing::ExtraSmall)
                                            ->addIcon('ChevronRight', function (Icon $i): void {
                                                $i->size(IconSize::Small);
                                            });
                                    });
                            })
                            ->addContainer(function (Container $narrow) use ($assets): void {
                                $narrow->spacing(Spacing::None)
                                    ->targetWidth(TargetWidth::VeryNarrow)
                                    ->horizontalAlignment(HorizontalAlignment::Center)
                                    ->addImage($assets . 'menuItem_3.png', function (Image $img): void {
                                        $img->width('64px')
                                            ->height('64px')
                                            ->style(ImageStyle::RoundedCorners);
                                    })
                                    ->addTextBlock('Japchae Noodle Bowl', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->weight(TextWeight::Bolder)
                                            ->spacing(Spacing::Small);
                                    })
                                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                                        $rtb->spacing(Spacing::None)
                                            ->inlines(
                                                TextRun::make('$14.00')
                                                    ->color(Colors::Attention)
                                                    ->strikethrough(true),
                                                TextRun::make('  $11.99')
                                                    ->isSubtle(true)
                                            );
                                    });
                            });
                    });
            })
            ->addContainer(function (Container $cont) use ($assets, $createToggleAction): void {
                $cont->id('info')
                    ->spacing(Spacing::Large)
                    ->isVisible(false)
                    ->addColumnSet(function (ColumnSet $cs) use ($assets, $createToggleAction): void {
                        $cs->spacing(Spacing::Large)
                            ->column(Width::Stretch, function (Column $c) use ($createToggleAction): void {
                                $c->selectAction($createToggleAction())
                                    ->addTextBlock('Menu', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->horizontalAlignment(HorizontalAlignment::Center);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c) use ($assets): void {
                                $c->addTextBlock('Info', function (TextBlock $t): void {
                                    $t->wrap(true)
                                        ->weight(TextWeight::Bolder)
                                        ->horizontalAlignment(HorizontalAlignment::Center);
                                })
                                    ->addContainer(function (Container $line) use ($assets): void {
                                        $line->backgroundImage(
                                            BackgroundImage::make($assets . 'tabline.png')
                                                ->fillMode(ImageFillMode::RepeatHorizontally)
                                                ->verticalAlignment(VerticalAlignment::Center)
                                        )
                                            ->minHeight('3px')
                                            ->style(ContainerStyle::Default)
                                            ->spacing(Spacing::None);
                                    });
                            });
                    })
                    ->addTextBlock('Food Stations', function (TextBlock $t): void {
                        $t->wrap(true)
                            ->weight(TextWeight::Bolder)
                            ->size(TextSize::Large);
                    })
                    ->addColumnSet(function (ColumnSet $cs): void {
                        $cs->spacing(Spacing::ExtraSmall)
                            ->column(Width::Auto, function (Column $c): void {
                                $c->spacing(Spacing::ExtraSmall)
                                    ->addIcon('Clock', function (Icon $i): void {
                                        $i->size(IconSize::XxSmall)
                                            ->spacing(Spacing::ExtraSmall);
                                    });
                            })
                            ->column(Width::Stretch, function (Column $c): void {
                                $c->spacing(Spacing::ExtraSmall)
                                    ->addTextBlock('Open Mon-Fri 8:00AM to 5:00PM', function (TextBlock $t): void {
                                        $t->wrap(true)
                                            ->spacing(Spacing::ExtraSmall)
                                            ->size(TextSize::Small)
                                            ->color(Colors::Default)
                                            ->isSubtle(true)
                                            ->weight(TextWeight::Bolder);
                                    });
                            });
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Pranzetto')->weight(TextWeight::Bolder),
                            TextRun::make(': Curated sandwiches on house-made focaccia, organic produce, and more')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Eat Local')->weight(TextWeight::Bolder),
                            TextRun::make(': Rotating local brands such as Kalia, Maya’s Mexican and Facing East')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Diner')->weight(TextWeight::Bolder),
                            TextRun::make(': All-day breakfast and lunch')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Grilled')->weight(TextWeight::Bolder),
                            TextRun::make(': Made-to-order grilled proteins and sides')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Mediterranean')->weight(TextWeight::Bolder),
                            TextRun::make(': An array of grilled meats, falafel wraps, mezze bowls, and fresh salads')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Street Food')->weight(TextWeight::Bolder),
                            TextRun::make(': Ready-to-eat bites including sandwiches, tacos, and more')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ World Flavors')->weight(TextWeight::Bolder),
                            TextRun::make(': Gourmet cuisines from around the globe')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Sprout')->weight(TextWeight::Bolder),
                            TextRun::make(': Self-service salad bar featuring a variety of toppings and gourmet soups')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Oma Bap')->weight(TextWeight::Bolder),
                            TextRun::make(': Homestyle Korean fried chicken and bibimbap')
                        );
                    })
                    ->addRichTextBlock(function (RichTextBlock $rtb): void {
                        $rtb->inlines(
                            TextRun::make('￭ Flora')->weight(TextWeight::Bolder),
                            TextRun::make(': Rotating vegan and vegetarian dishes')
                        );
                    });
            });

        $this->assertMatchesFixture($card, '13-cafeteria-24-menu');
    }

    /**
     * Asserts that the card serialises to the stored JSON fixture.
     *
     * @param string $fixture Fixture name, without the ".json" extension
     */
    private function assertMatchesFixture(AdaptiveCard $card, string $fixture): void
    {
        $path = dirname(__DIR__) . '/fixtures/' . $fixture . '.json';

        self::assertFileExists($path);

        $json = file_get_contents($path);
        self::assertIsString($json);

        $expected = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        self::assertIsArray($expected);

        self::assertEquals(
            $expected,
            $card->toArray(),
            sprintf('Card output does not match the "%s" fixture.', $fixture)
        );
    }
}
