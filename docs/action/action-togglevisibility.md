# Action.ToggleVisibility

**Works in:** Teams · Copilot · Outlook

Toggles the visibility of a set of elements. `Action.ToggleVisibility` is useful for creating "Show more" type UI patterns.

Use `Action.ToggleVisibility` when you need to show or hide a set of elements all at once in a card. `Action.ToggleVisibility` is particularly useful for creating a "Show more" experience, as shown below.

## Example

```json
{
  "type": "AdaptiveCard",
  "$schema": "https://adaptivecards.io/schemas/adaptive-card.json",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
      "wrap": true,
      "maxLines": 3,
      "id": "shortText"
    },
    {
      "type": "TextBlock",
      "text": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
      "wrap": true,
      "isVisible": false,
      "id": "longText"
    },
    {
      "type": "ActionSet",
      "actions": [
        {
          "type": "Action.ToggleVisibility",
          "title": "Show more",
          "targetElements": ["shortText", "longText", "showMore", "showLess"]
        }
      ],
      "id": "showMore"
    },
    {
      "type": "ActionSet",
      "actions": [
        {
          "type": "Action.ToggleVisibility",
          "title": "Show less",
          "targetElements": ["shortText", "longText", "showMore", "showLess"]
        }
      ],
      "id": "showLess",
      "isVisible": false
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.ToggleVisibility`. | 1.0 |
| `suppressAriaControls` | `boolean` | `false` | — | 1.5 |
| `targetElements` | `Array of string or object` | — | The IDs of the elements to toggle the visibility of. Valid values: `TargetElement`. | 1.2 |
| `behavior` | `string` | `"Default"` | **Preview.** Controls the behavior of the action. When set to `Toggle`, the action acts as a toggle that alternates between the normal and toggled states each time it's executed. Valid values: `"Default"`, `"Toggle"`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate action to render if the type of this one is unsupported or if the host application doesn't support all the capabilities specified in the `requires` property. See valid values below. | 1.2 |
| `iconUrl` | `string` | — | A URL (or Base64-encoded Data URI) to a PNG, GIF, JPEG or SVG image displayed to the left of the action's title. Also accepts `icon:<icon-name>[,regular\|filled]`, such as `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL used in the toggled state; accepts the same formats as `iconUrl`. Only applies when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an ID or they won't be validated and their values won't be sent to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state; applies only when `behavior` is `Toggle`. Valid values: `"Normal"`, `"Toggled"`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Controls the enabled state. A disabled action cannot be clicked, and button styling reflects the disabled state. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated to update `isEnabled` at runtime. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Controls action visibility. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated to update `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional object key. Rarely needed, but can help maintain visual state in the host. | 1.0 |
| `menuActions` | `Array of object` | — | **Teams.** Actions in the overflow menu of a Split action button. See valid values below. | 1.5 |
| `mode` | `string` | `"primary"` | Controls whether the action is primary or secondary. Secondary actions appear in an overflow menu. Valid values: `"primary"`, `"secondary"`. | 1.5 |
| `requires` | `object` | `{}` | Capabilities the host must support; if any are unsupported the element is not rendered, or a fallback is rendered if supplied. Valid values: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Controls the action's visual and spoken representations. Valid values: `"default"`, `"positive"`, `"destructive"`. | 1.2 |
| `themedIconUrls` | `Array of object` | — | **Teams.** Theme-specific icon URLs. Valid values: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | `Array of object` | — | **Preview.** Theme-specific icon URLs used in the toggled state; only applies when `behavior` is `Toggle`. Valid values: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | Title of the action as shown on buttons. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated to update `title` at runtime. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title displayed in the toggled state; only applies when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip displayed when hovering over the action. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated to update `tooltip` at runtime. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip displayed in the toggled state; only applies when `behavior` is `Toggle`. | 1.5 |

### Valid `fallback` values

`Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `"drop"`.

### Valid `menuActions` values

`Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`.

---

## TargetElement

**Works in:** Teams · Copilot · Outlook

Defines a target element in an `Action.ToggleVisibility`.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `elementId` | `string` | — | The ID of the element whose visibility should change. | 1.5 |
| `isVisible` | `boolean` | — | The new visibility state of the element. | 1.5 |
