# Action.ShowCard

**Works in:** Teams · Copilot · Outlook

Expands or collapses an embedded card within the main card.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.0",
  "body": [
    {
      "type": "TextBlock",
      "text": "**Action.ShowCard** is a great solution to show additional information or actions in a compact way. It allows you to show a card inline with the parent card, and the user can expand or collapse it as needed.",
      "wrap": true
    }
  ],
  "actions": [
    {
      "type": "Action.ShowCard",
      "title": "Expand/collapse embedded card",
      "card": {
        "type": "AdaptiveCard",
        "body": [
          {
            "type": "TextBlock",
            "text": "This is a card within a card. You can expand or collapse it as needed. It can contain anything, eve charts!",
            "wrap": true
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
          }
        ],
        "actions": [
          {
            "type": "Action.Submit",
            "title": "Neat!",
            "data": { "neat": "true" }
          }
        ]
      }
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.ShowCard`. | 1.0 |
| `card` | `object` | — | The card that should be displayed when the action is executed. Valid value: `AdaptiveCard`. | 1.0 |
| `behavior` | `string` | `"Default"` | **Preview.** Controls the behavior of the action. When set to `Toggle`, the action alternates between normal and toggled states each time it executes. Valid values: `Default`, `Toggle`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate action to render if this type is unsupported or the host does not support all required capabilities. Valid values: `Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `drop`. | 1.2 |
| `iconUrl` | `string` | — | URL or Base64 Data URI for a PNG, GIF, JPEG, or SVG displayed to the left of the title. Also accepts `icon:<icon-name>[,regular\|filled]`, such as `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL for the toggled state. Accepts the same formats as `iconUrl`. Applies only when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | Unique identifier for an element or action. Inputs must have an ID to be validated and included in data sent to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state, used only when `behavior` is `Toggle`. Valid values: `Normal`, `Toggled`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Whether the action is enabled. Disabled actions cannot be clicked, and buttons visually reflect that state. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isEnabled`. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Whether the action is visible. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key. Usually unnecessary; can help preserve visual state in a host application. | 1.0 |
| `menuActions` | `array of objects` | — | **Teams.** Actions in the overflow menu of a split action button. Valid values: `Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`. | 1.5 |
| `mode` | `string` | `"primary"` | Whether the action is primary or secondary. Secondary actions appear in an overflow menu. Valid values: `primary`, `secondary`. | 1.5 |
| `requires` | `object` | `{}` | List of host capabilities required. If unsupported, the element is not rendered, or its `fallback` is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Controls the action's visual and spoken representations. Valid values: `default`, `positive`, `destructive`. | 1.2 |
| `themedIconUrls` | `array of objects` | — | **Teams.** Theme-specific icon URLs. Valid value: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | `array of objects` | — | **Preview.** Theme-specific icon URLs for the toggled state, used only when `behavior` is `Toggle`. Valid value: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | Title of the action as displayed on buttons. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `title`. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title shown in the toggled state, used only when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip displayed when hovering over the action. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `tooltip`. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip shown in the toggled state, used only when `behavior` is `Toggle`. | 1.5 |
