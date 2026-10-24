# Action.OpenUrlDialog

**Works in:** Word · PowerPoint

Opens a task module in a modal dialog hosting the content at a provided URL.

> **Note:** `Action.OpenUrlDialog` is currently not supported in Teams. To achieve the same result in Teams, use `Action.Submit` with a subtype of `task/fetch`. See *Use dialogs in Microsoft Teams bots* for more details.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.OpenUrlDialog`. | 1.0 |
| `url` | `string` | — | The URL to open. | 1.5 |
| `behavior` | `string` | `"Default"` | **Preview.** Controls the behavior of the action. When set to `Toggle`, the action alternates between normal and toggled states each time it executes. Valid values: `"Default"`, `"Toggle"`. | 1.5 |
| `dialogHeight` | `string` | — | Height of the dialog. For pixels, use `<number>px`. Valid values: `"small"`, `"medium"`, `"large"`, `"<number>px"`. | 1.5 |
| `dialogTitle` | `string` | — | Title displayed in the dialog header. | 1.5 |
| `dialogWidth` | `string` | — | Width of the dialog. For pixels, use `<number>px`. Valid values: `"small"`, `"medium"`, `"large"`, `"<number>px"`. | 1.5 |
| `fallback` | `object` or `string` | — | Alternate action to render when this action or required capabilities are unsupported. Valid values listed below. | 1.2 |
| `iconUrl` | `string` | — | URL or Base64-encoded Data URI for a PNG, GIF, JPEG, or SVG image shown to the left of the title. Also supports `icon:<icon-name>[,regular\|filled]`, e.g. `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL for the toggled state; same formats as `iconUrl`. Applies only when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements require an `id` for validation and sending values to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state; only applies when `behavior` is `Toggle`. Valid values: `"Normal"`, `"Toggled"`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Controls whether the action is enabled. Disabled actions cannot be clicked; button appearance reflects this state. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isEnabled`. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Controls visibility of the action. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key. Rarely needed, but can help maintain visual state in the host application. | 1.0 |
| `menuActions` | Array of `object` | — | **Teams.** Actions in the overflow menu of a Split action button. Valid values listed below. | 1.5 |
| `mode` | `string` | `"primary"` | Controls primary versus secondary actions. Secondary actions appear in an overflow menu. Valid values: `"primary"`, `"secondary"`. | 1.5 |
| `requires` | `object` | `{}` | List of required host capabilities. If unsupported, action is not rendered or its fallback is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Controls the action's visual and spoken representation. Valid values: `"default"`, `"positive"`, `"destructive"`. | 1.2 |
| `themedIconUrls` | Array of `object` | — | **Teams.** Theme-specific icon URLs. Valid value: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | Array of `object` | — | **Preview.** Theme-specific icon URLs in toggled state; applies only when `behavior` is `Toggle`. Valid value: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | The action title shown on buttons. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `title`. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title in toggled state; applies only when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip displayed on hover. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `tooltip`. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip displayed in toggled state; applies only when `behavior` is `Toggle`. | 1.5 |

### Valid `fallback` values

- `Action.Submit`
- `Action.OpenUrl`
- `Action.Execute`
- `Action.ToggleVisibility`
- `Action.ShowCard`
- `Action.ResetInputs`
- `Action.Popover`
- `Action.OpenUrlDialog`
- `Action.InsertImage`
- `Action.RunCommands`
- `"drop"`

### Valid `menuActions` values

- `Action.Execute`
- `Action.InsertImage`
- `Action.OpenUrl`
- `Action.OpenUrlDialog`
- `Action.ResetInputs`
- `Action.RunCommands`
- `Action.Submit`
- `Action.ToggleVisibility`
