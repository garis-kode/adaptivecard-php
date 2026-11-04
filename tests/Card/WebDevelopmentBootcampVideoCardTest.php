<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ActionMode;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class WebDevelopmentBootcampVideoCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'web-development-bootcamp-video');
    }
}
