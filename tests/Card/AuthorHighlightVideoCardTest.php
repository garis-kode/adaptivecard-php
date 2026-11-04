<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Enum\Width;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class AuthorHighlightVideoCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'author-highlight-video');
    }
}
