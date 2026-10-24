# Input.Rating

**Works in:** Teams

An input to allow the user to rate something using stars.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Input.Rating",
      "id": "rating1",
      "label": "Pick a rating",
      "size": "medium",
      "isRequired": true,
      "errorMessage": "Please pick a rating"
    },
    {
      "type": "Input.Rating",
      "id": "rating2",
      "label": "Pick a rating",
      "allowHalfSteps": true,
      "size": "large",
      "isRequired": true,
      "errorMessage": "Please pick a rating",
      "color": "marigold",
      "value": 3
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.Rating`. | 1.0 |
| `allowHalfSteps` | `boolean` | `false` | Controls if the user can select half stars. | 1.5 |
| `color` | `string` | `"Neutral"` | The color of the stars. Valid values: `"Neutral"`, `"Marigold"`. | 1.5 |
| `max` | `number` | `5` | The number of stars to display. | 1.5 |
| `size` | `string` | `"Large"` | The size of the stars. Valid values: `"Medium"`, `"Large"`. | 1.5 |
| `value` | `number` | — | The default value of the input. | 1.5 |
| `errorMessage` | `string` | — | The error message to display when the input fails validation. See *Input validation* for more details. | 1.3 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or the host does not support capabilities listed in `requires`. See [Valid `fallback` values](#valid-fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | Element height. `"stretch"` uses remaining vertical space. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements must have an `id` or they will not be validated and their values will not be sent to the Bot. | 1.0 |
| `isRequired` | `boolean` | `false` | Whether the input is required. See *Input validation*. | 1.3 |
| `isSortKey` | `boolean` | `false` | Whether the element should be used as a sort key by elements supporting sorting across collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression whose evaluated value updates `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional object key. Rarely needed; can help preserve visual state in some host scenarios. | 1.0 |
| `label` | `string` | — | Label of the input. Always provide a label for the best experience, particularly for users of assistive technology. | 1.3 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `requires` | `object` | `{}` | Capabilities required of the host (`HostCapabilities`). If unsupported, element is not rendered or its fallback is rendered. | 1.2 |
| `separator` | `boolean` | `false` | Whether a separator line appears above the element. Not displayed for the first element in a container. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Whether the label is visually rendered. If `false`, it remains the accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Space between this and the previous element; no space for the first element in a container. See [Valid `spacing` values](#valid-spacing-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Responsive card-width condition for displaying the element. If unspecified, appears at all widths. See [Valid `targetWidth` values](#valid-targetwidth-values). | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** An action executed when the input value changes; described as an `Action.ResetInputs` action. Supported action types: `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`. | 1.5 |

## Valid values

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, or `"drop"`.

### Valid `spacing` values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

> **Note:** The JSON example retains the lowercase `size` and `color` strings from the supplied example, while the schema lists the capitalized valid values exactly as provided.
