# Rating

**Works in:** Teams

A read-only star rating element, to display the rating of something.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Rating",
      "value": 3.2,
      "size": "medium"
    },
    {
      "type": "Rating",
      "max": 20,
      "value": 3.2,
      "color": "marigold"
    },
    {
      "type": "Rating",
      "style": "compact",
      "value": 3.2,
      "color": "marigold",
      "count": 150
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Rating`. | 1.0 |
| `color` | `string` | `"Neutral"` | The color of the stars. Valid values: `"Neutral"`, `"Marigold"`. | 1.5 |
| `count` | `number` | — | The number of "votes" associated with the rating. | 1.5 |
| `max` | `number` | `5` | The number of stars to display. | 1.5 |
| `size` | `string` | `"Large"` | The size of the stars. Valid values: `"Medium"`, `"Large"`. | 1.5 |
| `style` | `string` | `"Default"` | The style of the stars. Valid values: `"Default"`, `"Compact"`. | 1.5 |
| `value` | `number` | — | The value of the rating. Must be between `0` and `max`. | 1.5 |
| `fallback` | `object or string` | — | An alternate element to render if this element is unsupported or the host does not support all capabilities specified in `requires`. See valid values below. | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. When `stretch`, it uses the remaining vertical space in its container. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `"Left"`, `"Center"`, `"Right"`. | 1.0 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an ID to be validated and sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is used as a sort key by elements that allow sorting across a collection of elements. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** An expression evaluated at runtime to update the `isVisible` property. | 1.5 |
| `key` | `string` | — | Optional object key. Seldom needed, but can help maintain visual state in the host application. | 1.0 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `requires` | `object` | `{}` | Capabilities the host must support; otherwise this element is not rendered, or its fallback is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Whether to display a separator above the element. No separator is displayed for the first element in a container. | 1.0 |
| `spacing` | `string` | `"Default"` | Space between this and the previous element; no space is added for the first element in a container. See valid values below. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Restricts the card widths at which the element is rendered. If omitted, rendered at all widths. See valid values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `spacing` values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.
