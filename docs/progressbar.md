# ProgressBar

**Works in:** Teams  
**Description:** A progress bar element, to represent a value within a range.

The `ProgressBar` element visually communicates progress or system states with modern, clear design. It helps users quickly assess whether a task is ongoing or a specific state (e.g., error or near-full capacity) exists.

## Card example: ProgressBar styles

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    { "type": "TextBlock", "text": "ProgressBar styles", "wrap": true, "size": "Large", "weight": "Bolder" },
    { "type": "ProgressBar" },
    { "type": "TextBlock", "text": "Indeterminate", "spacing": "ExtraSmall", "size": "Small" },
    { "type": "ProgressBar", "value": 20, "separator": true, "spacing": "ExtraLarge" },
    { "type": "TextBlock", "text": "Accent", "color": "Accent", "spacing": "ExtraSmall", "size": "Small" },
    { "type": "ProgressBar", "color": "Good", "value": 40, "spacing": "Large" },
    { "type": "TextBlock", "text": "Good", "color": "Good", "spacing": "ExtraSmall", "size": "Small" },
    { "type": "ProgressBar", "color": "Warning", "value": 60, "spacing": "Large" },
    { "type": "TextBlock", "text": "Warning", "color": "Warning", "spacing": "ExtraSmall", "size": "Small" },
    { "type": "ProgressBar", "color": "Attention", "value": 80, "spacing": "Large" },
    { "type": "TextBlock", "text": "Attention", "color": "Attention", "spacing": "ExtraSmall", "size": "Small" }
  ]
}
```

## Important

- **Reserve indeterminate feedback for processing:** Avoid mixing indeterminate and static states.
- **Semantic consistency:** Adhere to established color meanings (e.g., red for errors, green for success, yellow for warnings).
- **Accompany with text and/or icons:** Pair progress bars with textual labels and/or icons (using `TextBlock` and `Icon`, for example) to provide context, especially for users with vision impairments.
- **Update your card to update your progress bar:** Progress bars do not change client-side. To remove an indeterminate progress bar from the card, or to change the value of a static progress bar, use an update activity.

## Indeterminate mode

Use an indeterminate progress bar as an alternative to `ProgressRing` to indicate that a process is underway. It is ideal for scenarios where:

- A task is actively processing.
- Data is loading, and the content of your card might not yet be complete.
- An operation is ongoing but precise progress cannot be reported.

> **Tip:** To make a `ProgressBar` indeterminate, do not set its `value` property. In indeterminate mode, a `ProgressBar` will always use the accent color, regardless of the value of the `color` property.

## Static mode

Use a `ProgressBar` with static progress bar to provide a snapshot of a system or process state. Typical use case scenarios are:

- An ongoing loading operation with progress between 0 and 100%.
- A gauge indicating the available resources in a system.
- The number of responses to a question out of total in a survey.

Colors can be used to convey further detail:

- **Attention:** Conveys error or critical issues.
- **Warning:** Indicates cautionary conditions, such as nearing storage capacity.
- **Good:** Suggests success, the completion of a task or a satisfactory condition.
- **Accent:** Offers a neutral, cohesive design for use cases not tied to semantic messaging.

## Examples

### Let the user know their request is being processed

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Your request has been submitted",
      "wrap": true,
      "size": "Large",
      "weight": "Bolder"
    },
    { "type": "ProgressBar" },
    {
      "type": "TextBlock",
      "text": "Processing your request...",
      "spacing": "ExtraSmall",
      "size": "Small"
    }
  ]
}
```

### A task was successfully processed

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Your request completed",
      "wrap": true,
      "size": "Large",
      "weight": "Bolder"
    },
    { "type": "ProgressBar", "value": 100, "color": "Good" },
    {
      "type": "ColumnSet",
      "columns": [
        {
          "type": "Column",
          "width": "auto",
          "items": [
            { "type": "Icon", "name": "CheckmarkCircle", "size": "xxSmall", "color": "Good" }
          ],
          "verticalContentAlignment": "Center"
        },
        {
          "type": "Column",
          "width": "stretch",
          "items": [
            {
              "type": "TextBlock",
              "text": "The request was successfully processed",
              "spacing": "ExtraSmall",
              "size": "Small",
              "color": "Good"
            }
          ],
          "verticalContentAlignment": "Center",
          "spacing": "Small"
        }
      ],
      "spacing": "ExtraSmall"
    }
  ]
}
```

### A task failed

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Your request failed",
      "wrap": true,
      "size": "Large",
      "weight": "Bolder"
    },
    { "type": "ProgressBar", "value": 100, "color": "Attention" },
    {
      "type": "ColumnSet",
      "columns": [
        {
          "type": "Column",
          "width": "auto",
          "items": [
            { "type": "Icon", "name": "ErrorCircle", "size": "xxSmall", "color": "Attention" }
          ],
          "verticalContentAlignment": "Center"
        },
        {
          "type": "Column",
          "width": "stretch",
          "items": [
            {
              "type": "TextBlock",
              "text": "The request timed out",
              "spacing": "ExtraSmall",
              "size": "Small",
              "color": "Attention"
            }
          ],
          "verticalContentAlignment": "Center",
          "spacing": "Small"
        }
      ],
      "spacing": "ExtraSmall"
    }
  ]
}
```

### Storage space is running low

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    { "type": "ProgressBar", "value": 80, "color": "Warning" },
    {
      "type": "ColumnSet",
      "columns": [
        {
          "type": "Column",
          "width": "auto",
          "items": [
            { "type": "Icon", "name": "Warning", "size": "xxSmall", "color": "Warning" }
          ],
          "verticalContentAlignment": "Center"
        },
        {
          "type": "Column",
          "width": "stretch",
          "items": [
            {
              "type": "TextBlock",
              "text": "Warning: your storage is almost full",
              "spacing": "ExtraSmall",
              "size": "Small",
              "color": "Warning"
            }
          ],
          "verticalContentAlignment": "Center",
          "spacing": "Small"
        },
        {
          "type": "Column",
          "width": "auto",
          "items": [
            { "type": "TextBlock", "text": "22.5 of 25 MB used", "wrap": true, "size": "Small" }
          ]
        }
      ],
      "spacing": "ExtraSmall"
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `ProgressBar`. | 1.0 |
| `color` | string | `"Accent"` | The color of the progress bar. `color` has no effect in indeterminate mode, which always uses the accent color. Valid values: `"Accent"`, `"Good"`, `"Warning"`, `"Attention"`. | 1.5 |
| `max` | number | `100` | The maximum value of the progress bar. | 1.5 |
| `value` | number | — | The value of the progress bar. Must be between 0 and `max`. | 1.5 |
| `fallback` | object or string | — | An alternate element to render if this type is unsupported or the host lacks required capabilities. See valid values below. | 1.2 |
| `grid.area` | string | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | string | `"auto"` | Height; `"stretch"` uses remaining vertical space. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `horizontalAlignment` | string | — | Horizontal alignment. Valid values: `"Left"`, `"Center"`, `"Right"`. | 1.0 |
| `id` | string | — | A unique identifier for the element or action. Inputs must have an `id` to be validated and sent to the Bot. | 1.0 |
| `isSortKey` | boolean | `false` | Whether the element is used as a sort key by elements supporting sorting across a collection. | 1.5 |
| `isVisible` | boolean | `true` | Controls visibility of the element. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview.** Expression whose evaluated value updates `isVisible` at runtime. | 1.5 |
| `key` | string | — | Optional object key; may help maintain visual state in the host application. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `requires` | object | `{}` | Required host capabilities; uses fallback or does not render if unmet. Valid value: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Whether a separator is shown above the element. Not displayed for first element in a container. | 1.0 |
| `spacing` | string | `"Default"` | Spacing from preceding element (not applied to first element). Valid values: `"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`. | 1.0 |
| `targetWidth` | string | — | **Teams/Copilot.** Card widths on which the element appears. Omitted means all widths. See valid values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.
