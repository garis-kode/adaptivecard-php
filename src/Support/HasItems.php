<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Chart\Data\ChartSeries;
use AdaptiveCards\Chart\Data\DataPoint;
use AdaptiveCards\Chart\DonutChart;
use AdaptiveCards\Chart\Gauge\GaugeChart;
use AdaptiveCards\Chart\Gauge\GaugeSegment;
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
use AdaptiveCards\Enum\ChartColorSet;
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
        $image = (new Image())->url($url);

        return $this->addItem($this->configure($image, $configure));
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
        $factSet = new FactSet();
        if ($facts !== []) {
            $factSet->facts($facts);
        }

        return $this->addItem($this->configure($factSet, $configure));
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
        $codeBlock = (new CodeBlock())->codeSnippet($code)->language($language);

        return $this->addItem($this->configure($codeBlock, $configure));
    }

    public function addCompoundButton(
        ?string $title = null,
        ?string $description = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new CompoundButton($title, $description), $configure));
    }

    public function addIcon(string $name, ?callable $configure = null): static
    {
        $icon = (new Icon())->name($name);

        return $this->addItem($this->configure($icon, $configure));
    }

    public function addProgressBar(float|int|null $value = null, float|int $max = 100, ?callable $configure = null): static
    {
        $bar = new ProgressBar();
        if ($value !== null) {
            $bar->value($value);
        }
        if ($max !== 100) {
            $bar->max($max);
        }

        return $this->addItem($this->configure($bar, $configure));
    }

    /**
     * @param (callable(ProgressRing): mixed)|null $configure
     */
    public function addProgressRing(?string $label = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ProgressRing($label), $configure));
    }

    public function addRating(float|int|null $value = null, float|int $max = 5, ?callable $configure = null): static
    {
        $rating = new Rating();
        if ($value !== null) {
            $rating->value($value);
        }
        if ($max !== 5) {
            $rating->max($max);
        }

        return $this->addItem($this->configure($rating, $configure));
    }

    /**
     * @param (callable(TextInput): mixed)|null $configure
     */
    public function addTextInput(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new TextInput($id, $label, $placeholder), $configure));
    }

    /**
     * @param (callable(NumberInput): mixed)|null $configure
     */
    public function addNumberInput(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new NumberInput($id, $label, $placeholder), $configure));
    }

    /**
     * @param (callable(DateInput): mixed)|null $configure
     */
    public function addDateInput(string $id, ?string $label = null, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new DateInput($id, $label), $configure));
    }

    /**
     * @param (callable(TimeInput): mixed)|null $configure
     */
    public function addTimeInput(
        string $id,
        ?string $label = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new TimeInput($id, $label), $configure));
    }

    /**
     * @param (callable(ToggleInput): mixed)|null $configure
     */
    public function addToggleInput(
        string $id,
        ?string $title = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new ToggleInput($id, $title), $configure));
    }

    public function addChoiceSetInput(string $id, ?callable $configure = null): static
    {
        return $this->addItem($this->configure(new ChoiceSetInput($id), $configure));
    }

    /**
     * @param (callable(RatingInput): mixed)|null $configure
     */
    public function addRatingInput(
        string $id,
        ?string $label = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new RatingInput($id, $label), $configure));
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>>|null $data
     * @param (callable(DonutChart): mixed)|null $configure
     */
    public function addDonutChart(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new DonutChart($title, $showTitle, $data), $configure));
    }

    /**
     * @param iterable<GaugeSegment|array<string, mixed>>|null $segments
     * @param (callable(GaugeChart): mixed)|null $configure
     */
    public function addGaugeChart(
        string $title,
        ?bool $showTitle = null,
        float|int|null $value = null,
        ?iterable $segments = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new GaugeChart($title, $showTitle, $value, $segments), $configure));
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>> $data
     * @param (callable(HorizontalBarChart): mixed)|null $configure
     */
    public function addHorizontalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        string|ChartColorSet|null $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new HorizontalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
    }

    /**
     * @param iterable<ChartSeries|array<string, mixed>> $data
     * @param (callable(StackedHorizontalBarChart): mixed)|null $configure
     */
    public function addStackedHorizontalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new StackedHorizontalBarChart($title, $data, $showTitle), $configure));
    }

    /**
     * @param iterable<ChartSeries|array<string, mixed>>|null $data
     * @param (callable(LineChart): mixed)|null $configure
     */
    public function addLineChart(
        string $title,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        string|ChartColorSet|null $colorSet = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new LineChart($title, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet, $data), $configure));
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>>|null $data
     * @param (callable(PieChart): mixed)|null $configure
     */
    public function addPieChart(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new PieChart($title, $showTitle, $data), $configure));
    }

    /**
     * @param iterable<DataPoint|array<string, mixed>> $data
     * @param (callable(VerticalBarChart): mixed)|null $configure
     */
    public function addVerticalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        string|ChartColorSet|null $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new VerticalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
    }

    /**
     * @param iterable<ChartSeries|array<string, mixed>>|null $data
     * @param (callable(GroupedVerticalBarChart): mixed)|null $configure
     */
    public function addGroupedVerticalBarChart(
        string $title,
        ?iterable $data = null,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        string|ChartColorSet|null $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItem($this->configure(new GroupedVerticalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
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
