# ProgressRing

**Works in:** Teams

A spinning ring element, to indicate progress.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Different size rings",
      "size": "large"
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "style": "emphasis",
      "layouts": [
        {
          "type": "Layout.Flow",
          "columnSpacing": "ExtraLarge"
        }
      ],
      "items": [
        { "type": "ProgressRing", "size": "tiny", "label": "Tiny" },
        { "type": "ProgressRing", "size": "small", "label": "Small" },
        { "type": "ProgressRing", "label": "Medium" },
        { "type": "ProgressRing", "size": "Large", "label": "Large" }
      ]
    },
    {
      "type": "TextBlock",
      "text": "Label position",
      "size": "large",
      "spacing": "ExtraLarge"
    },
    {
      "type": "ColumnSet",
      "showBorder": true,
      "roundedCorners": true,
      "style": "emphasis",
      "columns": [
        {
          "type": "Column",
          "items": [
            {
              "type": "ProgressRing",
              "label": "Above (default)",
              "horizontalAlignment": "Center"
            }
          ]
        },
        {
          "type": "Column",
          "items": [
            {
              "type": "ProgressRing",
              "labelPosition": "Below",
              "label": "Below",
              "horizontalAlignment": "Center"
            }
          ]
        }
      ]
    },
    {
      "type": "ColumnSet",
      "showBorder": true,
      "roundedCorners": true,
      "style": "emphasis",
      "columns": [
        {
          "type": "Column",
          "items": [
            {
              "type": "ProgressRing",
              "label": "Before",
              "labelPosition": "Before",
              "horizontalAlignment": "Center"
            }
          ]
        },
        {
          "type": "Column",
          "items": [
            {
              "type": "ProgressRing",
              "labelPosition": "After",
              "label": "After",
              "horizontalAlignment": "Center"
            }
          ]
        }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `ProgressRing`. | 1.0 |
| `label` | `string` | — | The label of the progress ring. | 1.5 |
| `labelPosition` | `string` | `"Below"` | Controls the relative position of the label to the progress ring. Valid values: `"Before"`, `"After"`, `"Above"`, `"Below"`. | 1.5 |
| `size` | `string` | `"Medium"` | The size of the progress ring. Valid values: `"Tiny"`, `"Small"`, `"Medium"`, `"Large"`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate element to render if the type is unsupported or the host does not support required capabilities. See valid values below. | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. With `"stretch"`, uses remaining vertical space. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `horizontalAlignment` | `string` | — | How the element should be horizontally aligned. Valid values: `"Left"`, `"Center"`, `"Right"`. | 1.0 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an id to be validated and have their values sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is used as a sort key by elements that allow sorting across a collection of elements. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** An expression whose evaluated value updates `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional object key. Seldom needed, but can help maintain visual state in the host application. | 1.0 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `requires` | `object` | `{}` | List of host capabilities required to display the element; otherwise it is not rendered or its fallback is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Whether a separator line appears above the element. No separator appears for the first element in a container. | 1.0 |
| `spacing` | `string` | `"Default"` | Space between this element and the previous one. No space is added for the first element. Valid values: `"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Card widths at which to display this element. If unspecified, displays at all widths. See valid values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.
