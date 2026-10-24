# TextBlock

**Works in:** Teams · Copilot · Outlook

A block of text, optionally formatted using Markdown.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor",
      "wrap": true,
      "size": "Small"
    },
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor",
      "wrap": true,
      "size": "Default"
    },
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor",
      "wrap": true,
      "size": "Large"
    },
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor",
      "wrap": true,
      "size": "ExtraLarge"
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "TextBlock",
          "text": "Default",
          "wrap": true
        },
        {
          "type": "TextBlock",
          "text": "Accent",
          "wrap": true,
          "color": "Accent"
        },
        {
          "type": "TextBlock",
          "text": "Good",
          "wrap": true,
          "color": "Good"
        },
        {
          "type": "TextBlock",
          "text": "Warning",
          "wrap": true,
          "color": "Warning"
        },
        {
          "type": "TextBlock",
          "text": "Attention",
          "wrap": true,
          "color": "Attention"
        }
      ],
      "separator": true,
      "spacing": "ExtraLarge"
    },
    {
      "type": "TextBlock",
      "text": "Monospace",
      "wrap": true,
      "fontType": "Monospace",
      "size": "Large",
      "separator": true,
      "spacing": "ExtraLarge"
    }
  ]
}
```

## Formatting text

TextBlock elements can be formatted in multiple ways. Please refer to the following topics:

- Markdown
- Date and time formatting
- At mentions
- Citations

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `TextBlock`. | 1.0 |
| `labelFor` | string | — | **Teams.** The Id of the input the TextBlock should act as the label of. | 1.5 |
| `maxLines` | number | — | The maximum number of lines to display. | 1.0 |
| `style` | string | — | The style of the text. Valid values: `default`, `columnHeader`, `heading`. | 1.5 |
| `wrap` | boolean | `false` | Controls if the text should wrap. | 1.0 |
| `color` | string | — | The color of the text. Valid values: `Default`, `Dark`, `Light`, `Accent`, `Good`, `Warning`, `Attention`. | 1.0 |
| `fallback` | object or string | — | An alternate element to render if this type is unsupported, or if the host doesn't support required capabilities. See valid fallback values below. | 1.2 |
| `fontType` | string | — | Font type used for rendering. Valid values: `Default`, `Monospace`. | 1.2 |
| `grid.area` | string | — | **Teams.** Area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | string | `auto` | Height of the element; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | string | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | string | — | Unique identifier for the element or action. Inputs must have an id to be validated and sent to the Bot. | 1.0 |
| `isSortKey` | boolean | `false` | Controls whether the element is a sort key for elements that support sorting over a collection. | 1.5 |
| `isSubtle` | boolean | — | Controls whether the text should be rendered using a subtler variant of the selected color. | 1.0 |
| `isVisible` | boolean | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview.** Expression evaluated to update `isVisible` at runtime. | 1.5 |
| `key` | string | — | Optional object key. Rarely needed; can help preserve visual state. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `requires` | object | `{}` | Required host capabilities. If not supported, the element isn't rendered (or its fallback is used). Valid value: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Displays a separator above the element, except when it's the first element in a container. | 1.0 |
| `size` | string | — | Text size. Valid values: `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`. | 1.0 |
| `spacing` | string | `Default` | Space above the element, except when it's first in a container. Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `targetWidth` | string | — | **Teams/Copilot.** Restricts the card widths where the element is displayed. Without it, the element appears at all card widths. See valid widths below. | 1.0 |
| `text` | string | — | Text to display. Supports a subset of Markdown. | 1.0 |
| `text.dynamic` | string | — | **Preview.** Expression evaluated to update the TextBlock `text` at runtime. | 1.5 |
| `weight` | string | — | Text weight. Valid values: `Lighter`, `Default`, `Bolder`. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `drop`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
