<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Element\ColumnSet;
use AdaptiveCards\Element\Container;
use AdaptiveCards\Element\FactSet;
use AdaptiveCards\Element\Image;
use AdaptiveCards\Element\ImageSet;
use AdaptiveCards\Element\Media;
use AdaptiveCards\Element\RichTextBlock;
use AdaptiveCards\Element\Table;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Input\ChoiceSetInput;
use AdaptiveCards\Input\DateInput;
use AdaptiveCards\Input\NumberInput;
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
     * @param array<string, string>|list<\AdaptiveCards\Element\Fact> $facts
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
