<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Chart\DonutChart;
use AdaptiveCards\Chart\Gauge\GaugeChart;
use AdaptiveCards\Chart\HorizontalBar\HorizontalBarChart;
use AdaptiveCards\Chart\HorizontalBar\StackedHorizontalBarChart;
use AdaptiveCards\Chart\LineChart;
use AdaptiveCards\Chart\PieChart;
use AdaptiveCards\Chart\VerticalBar\GroupedVerticalBarChart;
use AdaptiveCards\Chart\VerticalBar\VerticalBarChart;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\Badge;
use AdaptiveCards\Element\Carousel\Carousel;
use AdaptiveCards\Element\CodeBlock;
use AdaptiveCards\Element\Column\ColumnSet;
use AdaptiveCards\Element\CompoundButton;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\Fact\Fact;
use AdaptiveCards\Element\Fact\FactSet;
use AdaptiveCards\Element\Icon;
use AdaptiveCards\Element\Image\Image;
use AdaptiveCards\Element\Image\ImageSet;
use AdaptiveCards\Element\Media\Media;
use AdaptiveCards\Element\Progress\ProgressBar;
use AdaptiveCards\Element\Progress\ProgressRing;
use AdaptiveCards\Element\Rating;
use AdaptiveCards\Element\RichTextBlock\RichTextBlock;
use AdaptiveCards\Element\Table\Table;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
use AdaptiveCards\Input\RatingInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\TimeInput;
use AdaptiveCards\Input\ToggleInput;

/**
 * Fluent helpers for nodes that hold a collection of child elements
 * (Container/Column via "items", AdaptiveCard via "body").
 *
 * Every add*() helper creates the element, hands it to an optional
 * configuration callback, appends it, and returns $this for chaining.
 */
trait HasItems
{
    /**
     * JSON key the items are stored under. AdaptiveCard overrides this to "body".
     */
    protected function itemsKey(): string
    {
        return 'items';
    }

    public function addItem(AbstractElement $element): static
    {
        return $this->push($this->itemsKey(), $element);
    }

    /**
     * @param iterable<AbstractElement> $elements
     */
    public function addItems(iterable $elements): static
    {
        foreach ($elements as $element) {
            $this->addItem($element);
        }

        return $this;
    }

    public function addTextBlock(string $text, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new TextBlock($text), $configure));
    }

    public function addImage(string $url, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Image($url), $configure));
    }

    public function addRichTextBlock(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new RichTextBlock(), $configure));
    }

    public function addContainer(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Container(), $configure));
    }

    public function addColumnSet(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ColumnSet(), $configure));
    }

    /**
     * @param array<string, string>|list<Fact> $facts
     */
    public function addFactSet(array $facts = [], ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new FactSet($facts), $configure));
    }

    public function addImageSet(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ImageSet(), $configure));
    }

    public function addMedia(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Media(), $configure));
    }

    public function addTable(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Table(), $configure));
    }

    public function addActionSet(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ActionSet(), $configure));
    }

    public function addBadge(string $text, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Badge($text), $configure));
    }

    public function addCarousel(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Carousel(), $configure));
    }

    public function addCodeBlock(string $code, string $language = 'PlainText', ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new CodeBlock($code, $language), $configure));
    }

    public function addCompoundButton(string $title, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new CompoundButton($title), $configure));
    }

    public function addIcon(string $name, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Icon($name), $configure));
    }

    public function addProgressBar(float|int|null $value = null, float|int $max = 100, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ProgressBar($value, $max), $configure));
    }

    public function addProgressRing(?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ProgressRing(), $configure));
    }

    public function addRating(float|int|null $value = null, float|int $max = 5, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new Rating($value, $max), $configure));
    }

    public function addTextInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new TextInput($id), $configure));
    }

    public function addNumberInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new NumberInput($id), $configure));
    }

    public function addDateInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new DateInput($id), $configure));
    }

    public function addTimeInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new TimeInput($id), $configure));
    }

    public function addToggleInput(string $id, string $title, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ToggleInput($id, $title), $configure));
    }

    public function addChoiceSetInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ChoiceSetInput($id), $configure));
    }

    public function addRatingInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new RatingInput($id), $configure));
    }

    public function addDonutChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(DonutChart::make($title), $configure));
    }

    public function addGaugeChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(GaugeChart::make($title), $configure));
    }

    public function addHorizontalBarChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(HorizontalBarChart::make($title), $configure));
    }

    public function addStackedHorizontalBarChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(StackedHorizontalBarChart::make($title), $configure));
    }

    public function addLineChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(LineChart::make($title), $configure));
    }

    public function addPieChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(PieChart::make($title), $configure));
    }

    public function addVerticalBarChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(VerticalBarChart::make($title), $configure));
    }

    public function addGroupedVerticalBarChart(?string $title = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(GroupedVerticalBarChart::make($title), $configure));
    }

    /**
     * @template T of object
     * @param T $element
     * @return T
     */
    private function configure(object $element, ?callable $configure): object
    {
        if ($configure !== null) {
            $configure($element);
        }

        return $element;
    }
}
