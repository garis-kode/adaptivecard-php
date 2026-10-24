# Action.Popover

**Works in:** Teams

Shows a popover to display more information to the user.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Click the button below to open a popover"
    }
  ],
  "actions": [
    {
      "type": "Action.Popover",
      "title": "Click me!",
      "maxPopoverWidth": "350px",
      "content": {
        "type": "Container",
        "items": [
          {
            "type": "TextBlock",
            "weight": "bolder",
            "size": "large",
            "text": "This is a popover"
          },
          {
            "type": "TextBlock",
            "text": "This popover is made with Adaptive Card elements. It can contain anything like charts and even action buttons!"
          },
          {
            "type": "Chart.Pie",
            "colorSet": "categorical",
            "data": [
              { "legend": "Pear", "value": 59 },
              { "legend": "Banana", "value": 292 },
              { "legend": "Apple", "value": 143 },
              { "legend": "Peach", "value": 98 },
              { "legend": "Kiwi", "value": 179 },
              { "legend": "Grapefruit", "value": 50 },
              { "legend": "Orange", "value": 212 },
              { "legend": "Cantaloupe", "value": 68 }
            ]
          },
          {
            "type": "ActionSet",
            "actions": [
              {
                "type": "Action.OpenUrl",
                "title": "Open URL",
                "tooltip": "Click me",
                "url": "https://www.microsoft.com"
              }
            ]
          }
        ]
      }
    }
  ]
}
```

## Usage

Use `Action.Popover` to show additional information to the end-user in a **popover bubble** that displays on top of the card when the element it is associated with is clicked. The content of the popover bubble can be made of any Adaptive Card elements.

`Action.Popover` is particularly useful for:

- Showing help or additional details such as a definition or chart.
- Showing a confirmation dialog for destructive actions.

### Confirmation example (displayed content)

> **Please review your order**
>
> **Item:** Zombie Halloween costume  
> **Quantity:** 1  
> **Price:** $14.99  
>
> **Confirm** · **Cancel**

*The provided source includes rendered content for this example but no JSON payload.*

> **Important**
> - Only use `Action.Popover` for non-essential information.
> - Use `Action.Popover` only when really necessary.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.Popover`. | 1.0 |
| `content` | `object` | — | The content of the popover, which can be any element. See valid values below. | 1.5 |
| `displayArrow` | `boolean` | `true` | Controls if an arrow should be displayed towards the element that triggered the popover. | 1.5 |
| `maxPopoverWidth` | `string` | — | Maximum width of the popover in pixels, in the `<number>px` format. | 1.5 |
| `popoverTitle` | `string` | — | **Preview.** Optional title of the popover, displayed only on mobile devices. | 1.5 |
| `position` | `string` | `"Above"` | Position relative to the triggering element. Valid values: `Above`, `Below`, `Before`, `After`. | 1.5 |
| `behavior` | `string` | `"Default"` | **Preview.** `Toggle` alternates between normal and toggled states on execution. Valid values: `Default`, `Toggle`. | 1.5 |
| `fallback` | `object` or `string` | — | Alternate action when unsupported or required capabilities are absent. See valid values below. | 1.2 |
| `iconUrl` | `string` | — | PNG/GIF/JPEG/SVG URL or Base64 Data URI shown to the left of the title. Also accepts `icon:<icon-name>[,regular\|filled]`, e.g. `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL in toggled state; same formats as `iconUrl`. Only when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | Unique identifier for element/action. Inputs need an ID for validation and submission to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state, when `behavior` is `Toggle`. Valid values: `Normal`, `Toggled`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Whether the action is enabled and can be clicked. Disabled buttons reflect this state visually. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated to update `isEnabled` at runtime. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Controls action visibility. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated to update `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional object key. Occasionally useful to maintain visual state in the host. | 1.0 |
| `mode` | `string` | `"primary"` | Primary actions appear directly; secondary actions appear in an overflow menu. Valid values: `primary`, `secondary`. | 1.5 |
| `requires` | `object` | `{}` | Required host capabilities; if unsupported, element or its fallback is not rendered. Valid values: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Visual and spoken representation of action. Valid values: `default`, `positive`, `destructive`. | 1.2 |
| `themedIconUrls` | `array of objects` | — | **Teams.** Theme-specific icon URLs. Valid values: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | `array of objects` | — | **Preview.** Theme-specific icon URLs in toggled state, only when `behavior` is `Toggle`. Valid values: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | Button title. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated to update the action title at runtime. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title in toggled state, only when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip shown on hover. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated to update tooltip at runtime. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip in toggled state, only when `behavior` is `Toggle`. | 1.5 |

### Valid `content` values

`Accordion`, `ActionSet`, `Badge`, `Carousel`, `Chart.Donut`, `Chart.Gauge`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Pie`, `Chart.VerticalBar`, `Chart.VerticalBar.Grouped`, `CitationRun`, `CodeBlock`, `ColumnSet`, `Calendar event`, `File`, `Graph resource`, `Persona`, `PersonaSet`, `CompoundButton`, `Container`, `FactSet`, `Icon`, `IconRun`, `Image`, `ImageRun`, `ImageSet`, `Input.ChoiceSet`, `Input.Date`, `Input.Number`, `Input.Rating`, `Input.Text`, `Input.Time`, `Input.Toggle`, `LoopComponent`, `Media`, `ProgressBar`, `ProgressRing`, `Rating`, `RichTextBlock`, `Table`, `TabSet`, `TextBlock`, `TextRun`.

### Valid `fallback` values

`Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `"drop"`.
