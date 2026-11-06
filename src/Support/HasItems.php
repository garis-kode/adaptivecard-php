<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Chart\Donut\DonutChart;
use AdaptiveCards\Chart\Donut\DonutChartData;
use AdaptiveCards\Chart\Gauge\GaugeChart;
use AdaptiveCards\Chart\Gauge\GaugeChartLegend;
use AdaptiveCards\Chart\HorizontalBar\HorizontalBarChart;
use AdaptiveCards\Chart\HorizontalBar\HorizontalBarChartDataValue;
use AdaptiveCards\Chart\HorizontalBar\StackedHorizontalBarChart;
use AdaptiveCards\Chart\HorizontalBar\StackedHorizontalBarChartData;
use AdaptiveCards\Chart\Line\LineChart;
use AdaptiveCards\Chart\Line\LineChartData;
use AdaptiveCards\Chart\Pie\PieChart;
use AdaptiveCards\Chart\VerticalBar\GroupedVerticalBarChart;
use AdaptiveCards\Chart\VerticalBar\GroupedVerticalBarChartData;
use AdaptiveCards\Chart\VerticalBar\VerticalBarChart;
use AdaptiveCards\Chart\VerticalBar\VerticalBarChartDataValue;
use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Element\Accordion;
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
use AdaptiveCards\Element\TabSet;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\ChartColorSet;
use AdaptiveCards\Enum\CodeBlockLanguage;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
use AdaptiveCards\Input\RatingInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\TimeInput;
use AdaptiveCards\Input\ToggleInput;

trait HasItems
{
    /**
     * JSON key the items are stored under. AdaptiveCard overrides this to "body".
     */
    protected function itemsKey(): string
    {
        return 'items';
    }

    /**
     * Add one or more block elements.
     *
     * @param AbstractBlockElement|iterable<AbstractBlockElement> $element
     */
    public function addItems(AbstractBlockElement|iterable $element): static
    {
        if (is_iterable($element)) {
            foreach ($element as $item) {
                $this->push($this->itemsKey(), $item);
            }

            return $this;
        }

        return $this->push($this->itemsKey(), $element);
    }

    /**
     * The items in the container.
     *
     * @param iterable<AbstractBlockElement> $elements
     */
    public function items(iterable $elements): static
    {
        return $this->addItems($elements);
    }

    /**
     * Add a block of text, optionally formatted using Markdown.
     *
     * @param (callable(TextBlock): mixed)|null $configure
     */
    public function addTextBlock(string $text, ?callable $configure = null): static
    {
        return $this->addItems($this->configure(new TextBlock($text), $configure));
    }

    /**
     * Add a standalone image element.
     *
     * @param (callable(Image): mixed)|null $configure
     */
    public function addImage(string $url, ?callable $configure = null): static
    {
        $image = (new Image())->url($url);

        return $this->addItems($this->configure($image, $configure));
    }

    /**
     * Add a rich text block that displays formatted text.
     *
     * @param (callable(RichTextBlock): mixed)|null $configure
     */
    public function addRichTextBlock(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new RichTextBlock(), $configure));
    }

    /**
     * Add a container for other elements.
     *
     * @param (callable(Container): mixed)|null $configure
     */
    public function addContainer(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Container(), $configure));
    }

    /**
     * Add a set of columns, splitting the available horizontal space so elements
     * can be organized in a row.
     *
     * @param (callable(ColumnSet): mixed)|null $configure
     */
    public function addColumnSet(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new ColumnSet(), $configure));
    }

    /**
     * Add a set of facts, displayed as a table or a vertical list when horizontal
     * space is constrained.
     *
     * @param iterable<Fact>                  $facts
     * @param (callable(FactSet): mixed)|null $configure
     */
    public function addFactSet(iterable $facts = [], ?callable $configure = null): static
    {
        $factSet = new FactSet();
        $factSet->facts($facts);

        return $this->addItems($this->configure($factSet, $configure));
    }

    /**
     * Add a set of images, displayed side-by-side and wrapped across multiple rows
     * as needed.
     *
     * @param (callable(ImageSet): mixed)|null $configure
     */
    public function addImageSet(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new ImageSet(), $configure));
    }

    /**
     * Add a media element, making it possible to embed videos inside a card.
     *
     * @param (callable(Media): mixed)|null $configure
     */
    public function addMedia(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Media(), $configure));
    }

    /**
     * Add a table to display data in a tabular way, with rows, columns and cells.
     *
     * @param (callable(Table): mixed)|null $configure
     */
    public function addTable(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Table(), $configure));
    }

    /**
     * Add an action set, which can be placed anywhere in the card.
     *
     * @param (callable(ActionSet): mixed)|null $configure
     */
    public function addActionSet(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new ActionSet(), $configure));
    }

    /**
     * Add a badge element to show an icon and/or text in a compact form over a
     * colored background.
     *
     * @param (callable(Badge): mixed)|null $configure
     */
    public function addBadge(?string $text = null, ?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Badge($text), $configure));
    }

    /**
     * Add a carousel with sliding pages.
     *
     * @param (callable(Carousel): mixed)|null $configure
     */
    public function addCarousel(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Carousel(), $configure));
    }

    /**
     * Add an accordion, allowing the end-user to toggle the display of content by
     * expanding or collapsing pages.
     *
     * @param (callable(Accordion): mixed)|null $configure
     */
    public function addAccordion(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new Accordion(), $configure));
    }

    /**
     * Add a tab set, allowing the end-user to navigate through pages using a tabbed
     * interface.
     *
     * @param (callable(TabSet): mixed)|null $configure
     */
    public function addTabSet(?callable $configure = null): static
    {
        return $this->addItems($this->configure(new TabSet(), $configure));
    }

    /**
     * Add a formatted and syntax-colored code block.
     *
     * @param (callable(CodeBlock): mixed)|null $configure
     */
    public function addCodeBlock(
        string $code,
        CodeBlockLanguage $language = CodeBlockLanguage::PlainText,
        ?callable $configure = null,
    ): static {
        $codeBlock = (new CodeBlock())->codeSnippet($code)->language($language);

        return $this->addItems($this->configure($codeBlock, $configure));
    }

    /**
     * Add a special type of button with an icon, title and description.
     *
     * @param (callable(CompoundButton): mixed)|null $configure
     */
    public function addCompoundButton(
        ?string $title = null,
        ?string $description = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new CompoundButton($title, $description), $configure));
    }

    /**
     * Add a standalone icon element. Icons can be picked from the vast Adaptive Card
     * icon catalog.
     *
     * @param (callable(Icon): mixed)|null $configure
     */
    public function addIcon(string $name, ?callable $configure = null): static
    {
        $icon = (new Icon())->name($name);

        return $this->addItems($this->configure($icon, $configure));
    }

    /**
     * Add a progress bar element to represent a value within a range.
     *
     * @param (callable(ProgressBar): mixed)|null $configure
     */
    public function addProgressBar(float|int|null $value = null, float|int $max = 100, ?callable $configure = null): static
    {
        $bar = new ProgressBar();
        if ($value !== null) {
            $bar->value($value);
        }
        if ($max !== 100) {
            $bar->max($max);
        }

        return $this->addItems($this->configure($bar, $configure));
    }

    /**
     * Add a spinning ring element to indicate progress.
     *
     * @param (callable(ProgressRing): mixed)|null $configure
     */
    public function addProgressRing(?string $label = null, ?callable $configure = null): static
    {
        return $this->addItems($this->configure(new ProgressRing($label), $configure));
    }

    /**
     * Add a read-only star rating element to display the rating of something.
     *
     * @param (callable(Rating): mixed)|null $configure
     */
    public function addRating(float|int|null $value = null, float|int $max = 5, ?callable $configure = null): static
    {
        $rating = new Rating();
        if ($value !== null) {
            $rating->value($value);
        }
        if ($max !== 5) {
            $rating->max($max);
        }

        return $this->addItems($this->configure($rating, $configure));
    }

    /**
     * Add an input to allow the user to enter text.
     *
     * @param (callable(TextInput): mixed)|null $configure
     */
    public function addTextInput(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new TextInput($id, $label, $placeholder), $configure));
    }

    /**
     * Add an input to allow the user to enter a number.
     *
     * @param (callable(NumberInput): mixed)|null $configure
     */
    public function addNumberInput(
        string $id,
        ?string $label = null,
        ?string $placeholder = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new NumberInput($id, $label, $placeholder), $configure));
    }

    /**
     * Add an input to allow the user to select a date.
     *
     * @param (callable(DateInput): mixed)|null $configure
     */
    public function addDateInput(string $id, ?string $label = null, ?callable $configure = null): static
    {
        return $this->addItems($this->configure(new DateInput($id, $label), $configure));
    }

    /**
     * Add an input to allow the user to select a time.
     *
     * @param (callable(TimeInput): mixed)|null $configure
     */
    public function addTimeInput(
        string $id,
        ?string $label = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new TimeInput($id, $label), $configure));
    }

    /**
     * Add an input to allow the user to select between on/off states.
     *
     * @param (callable(ToggleInput): mixed)|null $configure
     */
    public function addToggleInput(
        string $id,
        ?string $title = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new ToggleInput($id, $title), $configure));
    }

    /**
     * Add an input to allow the user to select one or more values.
     *
     * @param (callable(ChoiceSetInput): mixed)|null $configure
     */
    public function addChoiceSetInput(string $id, ?callable $configure = null): static
    {
        return $this->addItems($this->configure(new ChoiceSetInput($id), $configure));
    }

    /**
     * Add an input to allow the user to rate something using stars.
     *
     * @param (callable(RatingInput): mixed)|null $configure
     */
    public function addRatingInput(
        string $id,
        ?string $label = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new RatingInput($id, $label), $configure));
    }

    /**
     * Add a donut chart.
     *
     * @param iterable<DonutChartData>|null      $data
     * @param (callable(DonutChart): mixed)|null $configure
     */
    public function addDonutChart(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new DonutChart($title, $showTitle, $data), $configure));
    }

    /**
     * Add a gauge chart.
     *
     * @param iterable<GaugeChartLegend>|null    $segments
     * @param (callable(GaugeChart): mixed)|null $configure
     */
    public function addGaugeChart(
        string $title,
        ?bool $showTitle = null,
        float|int|null $value = null,
        ?iterable $segments = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new GaugeChart($title, $showTitle, $value, $segments), $configure));
    }

    /**
     * Add a horizontal bar chart.
     *
     * @param iterable<HorizontalBarChartDataValue>      $data
     * @param (callable(HorizontalBarChart): mixed)|null $configure
     */
    public function addHorizontalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new HorizontalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
    }

    /**
     * Add a stacked horizontal bar chart.
     *
     * @param iterable<StackedHorizontalBarChartData>           $data
     * @param (callable(StackedHorizontalBarChart): mixed)|null $configure
     */
    public function addStackedHorizontalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new StackedHorizontalBarChart($title, $data, $showTitle), $configure));
    }

    /**
     * Add a line chart.
     *
     * @param iterable<LineChartData>|null      $data
     * @param (callable(LineChart): mixed)|null $configure
     */
    public function addLineChart(
        string $title,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new LineChart($title, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet, $data), $configure));
    }

    /**
     * Add a pie chart.
     *
     * @param iterable<DonutChartData>|null    $data
     * @param (callable(PieChart): mixed)|null $configure
     */
    public function addPieChart(
        string $title,
        ?bool $showTitle = null,
        ?iterable $data = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new PieChart($title, $showTitle, $data), $configure));
    }

    /**
     * Add a vertical bar chart.
     *
     * @param iterable<VerticalBarChartDataValue>      $data
     * @param (callable(VerticalBarChart): mixed)|null $configure
     */
    public function addVerticalBarChart(
        string $title,
        iterable $data,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new VerticalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
    }

    /**
     * Add a grouped vertical bar chart.
     *
     * @param iterable<GroupedVerticalBarChartData>|null      $data
     * @param (callable(GroupedVerticalBarChart): mixed)|null $configure
     */
    public function addGroupedVerticalBarChart(
        string $title,
        ?iterable $data = null,
        ?bool $showTitle = null,
        ?string $xAxisTitle = null,
        ?string $yAxisTitle = null,
        ?ChartColorSet $colorSet = null,
        ?callable $configure = null,
    ): static {
        return $this->addItems($this->configure(new GroupedVerticalBarChart($title, $data, $showTitle, $xAxisTitle, $yAxisTitle, $colorSet), $configure));
    }

    /**
     * @template T of object
     *
     * @param T $element
     *
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
