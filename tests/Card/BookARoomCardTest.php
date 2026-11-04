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
use AdaptiveCards\Enum\ChoiceInputStyle;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\ItemFit;
use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\RatingInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\TimeInput;
use AdaptiveCards\Layout\FlowLayout;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class BookARoomCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'book-a-room');
    }
}
