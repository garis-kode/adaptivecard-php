# Action.ResetInputs

**Works in:** Teams

Resets the values of the inputs in the card.

Use `Action.ResetInputs` to offer a way to the end user to start over and/or to link inputs together.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Fill in the fields and hit \"Reset\" to see **Action.ResetInputs** in action.",
      "wrap": true
    },
    {
      "type": "Input.Text",
      "label": "Text input",
      "placeholder": "Placeholder text",
      "id": "text"
    },
    {
      "type": "Input.Date",
      "label": "Date input",
      "id": "date"
    },
    {
      "type": "Input.ChoiceSet",
      "label": "ChoiceSet input",
      "choices": [
        { "title": "Choice 1", "value": "value1" },
        { "title": "Choice 2", "value": "value2" }
      ],
      "placeholder": "Placeholder text",
      "id": "choiceset"
    }
  ],
  "actions": [
    {
      "type": "Action.ResetInputs",
      "title": "Reset",
      "targetInputIds": ["text", "date", "choiceset"]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.ResetInputs`. | 1.0 |
| `targetInputIds` | `Array of string` | — | The IDs of the inputs that should be reset. | 1.5 |
| `behavior` | `string` | `"Default"` | **Preview.** Controls the behavior of the action. When set to `Toggle`, the action alternates between normal and toggled states each time it is executed. Valid values: `"Default"`, `"Toggle"`. | 1.5 |
| `fallback` | `object` or `string` | — | Alternate action to render when unsupported or when required host capabilities are unavailable. See valid values below. | 1.2 |
| `iconUrl` | `string` | — | URL or Base64-encoded Data URI for a PNG, GIF, JPEG, or SVG image displayed to the left of the action title. Also accepts `icon:<icon-name>[,regular\|filled]`, e.g. `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL for toggled state; same formats as `iconUrl`. Only when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements require an ID to be validated and sent to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state; only when `behavior` is `Toggle`. Valid values: `"Normal"`, `"Toggled"`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Whether the action is enabled. Disabled actions cannot be clicked and button appearance reflects this state. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isEnabled`. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Whether the action is visible. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key. Seldom needed, but may help preserve visual state in the host application. | 1.0 |
| `menuActions` | `Array of object` | — | **Teams.** Actions displayed in the overflow menu of a Split action button. See valid values below. | 1.5 |
| `mode` | `string` | `"primary"` | Whether the action is primary or secondary. Secondary actions appear in an overflow menu. Valid values: `"primary"`, `"secondary"`. | 1.5 |
| `requires` | `object` | `{}` | List of required host capabilities. If unsupported, the element is not rendered or its fallback is used. Valid value: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Controls visual and spoken representation of the action. Valid values: `"default"`, `"positive"`, `"destructive"`. | 1.2 |
| `themedIconUrls` | `Array of object` | — | **Teams.** Theme-specific icon URLs. Valid value: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | `Array of object` | — | **Preview.** Theme-specific icon URLs for toggled state; only when `behavior` is `Toggle`. Valid value: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | Action title as displayed on buttons. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `title`. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title displayed in toggled state; only when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip displayed when the action is hovered over. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `tooltip`. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip in toggled state; only when `behavior` is `Toggle`. | 1.5 |

### Valid `fallback` values

`Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `"drop"`.

### Valid `menuActions` values

`Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`.
