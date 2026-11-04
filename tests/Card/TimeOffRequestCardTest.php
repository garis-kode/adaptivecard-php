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
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ActionStyle;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\ItemFit;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\ToggleInput;
use AdaptiveCards\Layout\FlowLayout;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class TimeOffRequestCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'time-off-request');
    }
}
