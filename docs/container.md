# Container

**Works in:** Teams · Copilot · Outlook

A container for other elements. Use containers for styling purposes and/or to logically group a set of elements together, which can be especially useful when used with `Action.ToggleVisibility`.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Default container style",
          "wrap": true,
          "size": "Large"
        }
      ]
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Emphasis container style",
          "wrap": true,
          "size": "Large"
        }
      ],
      "style": "emphasis"
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Accent container style",
          "wrap": true,
          "size": "Large",
          "color": "Accent"
        }
      ],
      "style": "accent"
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Good container style",
          "wrap": true,
          "size": "Large",
          "color": "Good"
        }
      ],
      "style": "good"
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Attention container style",
          "wrap": true,
          "size": "Large",
          "color": "Attention"
        }
      ],
      "style": "attention"
    },
    {
      "type": "Container",
      "showBorder": true,
      "roundedCorners": true,
      "items": [
        {
          "type": "TextBlock",
          "text": "Warning container style",
          "wrap": true,
          "size": "Large",
          "color": "Warning"
        }
      ],
      "style": "warning"
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Container`. | 1.0 |
| `backgroundImage` | `string or object` | — | Defines the container's background image. Valid values: `BackgroundImage`. | 1.0 |
| `items` | `array of object` | — | The elements in the container. Valid values: `Accordion`, `ActionSet`, `Badge`, `Carousel`, `Chart.Donut`, `Chart.Gauge`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Pie`, `Chart.VerticalBar`, `Chart.VerticalBar.Grouped`, `CodeBlock`, `ColumnSet`, `Calendar event`, `File`, `Graph resource`, `Persona`, `PersonaSet`, `CompoundButton`, `Container`, `FactSet`, `Icon`, `Image`, `ImageSet`, `Input.ChoiceSet`, `Input.Date`, `Input.Number`, `Input.Rating`, `Input.Text`, `Input.Time`, `Input.Toggle`, `LoopComponent`, `Media`, `ProgressBar`, `ProgressRing`, `Rating`, `RichTextBlock`, `Table`, `TabSet`, `TextBlock`. | 1.0 |
| `maxHeight` | `string` | — | **Teams.** The maximum height of the container in pixels (`<number>px`). When content exceeds this height, a vertical scrollbar appears. | 1.5 |
| `rtl` | `boolean` | — | Controls whether card content is rendered left-to-right or right-to-left. | 1.0 |
| `verticalContentAlignment` | `string` | — | Controls vertical alignment. Valid values: `Top`, `Center`, `Bottom`. | 1.1 |
| `bleed` | `boolean` | `false` | Controls whether the container extends into its parent's padding (edge-to-edge content). | 1.2 |
| `fallback` | `object or string` | — | Alternate element if the type or required capabilities are unsupported. See valid values below. | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | Height of the element. `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements must have an ID to be validated and submit values to the bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is used as a sort key for elements supporting collection sorting. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key, sometimes useful for preserving visual state in the host. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `layouts` | `array of object` | — | **Teams.** Layouts associated with the container, which may switch as the card width changes. Valid values: `Layout.Stack`, `Layout.Flow`, `Layout.AreaGrid`. | 1.5 |
| `minHeight` | `string` | — | Minimum height in pixels. Valid value: `<number>px`. | 1.2 |
| `requires` | `object` | `{}` | Required host capabilities; when unsupported, the element is not rendered or its fallback is used. Valid value: `HostCapabilities`. | 1.2 |
| `roundedCorners` | `boolean` | `false` | **Teams.** Whether the container has rounded corners. | 1.5 |
| `selectAction` | `object` | — | Action invoked when the element is tapped or clicked. `Action.ShowCard` is not supported. Valid values: `Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`. | 1.1 |
| `separator` | `boolean` | `false` | Displays a separator above the element, except for the first element in a container. | 1.0 |
| `showBorder` | `boolean` | `false` | **Teams.** Whether a border is displayed around the container. | 1.5 |
| `spacing` | `string` | `"Default"` | Spacing from preceding element; no space added for first element in a container. Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `style` | `string` | — | Container background, border, and text style designed to satisfy contrast requirements. Valid values: `default`, `emphasis`, `accent`, `good`, `attention`, `warning`. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Card widths where the element is rendered; without this, it renders at all widths. See valid values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
