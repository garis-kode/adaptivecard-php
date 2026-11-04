<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Card;

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Action\ToggleVisibility\TargetElement;
use AdaptiveCards\Action\ToggleVisibility\ToggleVisibilityAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\RichTextBlock\TextRun;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\FontType;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Tests\Support\CardFixtureTestCase;

final class RecipeCardTest extends CardFixtureTestCase
{
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

        $this->assertMatchesFixture($card, 'recipe');
    }
}
