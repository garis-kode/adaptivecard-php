<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
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
use AdaptiveCards\Enum\ImageFillMode;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class CafeMenuCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'cafe-menu');
    }
}
