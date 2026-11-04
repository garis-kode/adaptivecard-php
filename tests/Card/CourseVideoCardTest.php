<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\Rating;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\RatingColor;
use AdaptiveCards\Enum\RatingSize;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class CourseVideoCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'course-video');
    }
}
