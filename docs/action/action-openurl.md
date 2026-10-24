# Action.OpenUrl

**Works in:** Teams, Copilot, Outlook

Opens the provided URL in either a separate browser tab or within the host application.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Action.OpenUrl`. | 1.0 |
| `url` | `string` | — | The URL to open. | 1.0 |
| `behavior` | `string` | `"Default"` | **Preview.** Controls the behavior of the action. When set to `Toggle`, the action alternates between normal and toggled states each time it executes. Valid values: `"Default"`, `"Toggle"`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate action to render if unsupported, or if the host doesn't support all capabilities in `requires`. Valid values: `Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `"drop"`. | 1.2 |
| `iconUrl` | `string` | — | URL or Base64-encoded Data URI to a PNG, GIF, JPEG, or SVG shown to the left of the title. Also accepts `icon:<icon-name>[,regular\|filled]`, such as `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | `string` | — | **Preview.** Icon URL for the toggled state; same formats as `iconUrl`. Applies only when `behavior` is `Toggle`. | 1.5 |
| `id` | `string` | — | Unique identifier for the element or action. Inputs need an `id` to be validated and submitted to the Bot. | 1.0 |
| `initialState` | `string` | `"Normal"` | **Preview.** Initial toggle state; applies only when `behavior` is `Toggle`. Valid values: `"Normal"`, `"Toggled"`. | 1.5 |
| `isEnabled` | `boolean` | `true` | Controls whether the action is enabled. Disabled actions cannot be clicked and buttons reflect the disabled state. | 1.5 |
| `isEnabled.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isEnabled`. | 1.5 |
| `isVisible` | `boolean` | `true` | **Preview.** Controls visibility of the action. | 1.5 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional key for the object, rarely needed; can help maintain visual state in the host. | 1.0 |
| `menuActions` | Array of `object` | — | **Teams.** Actions in the overflow menu of a split action button. Valid values: `Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`. | 1.5 |
| `mode` | `string` | `"primary"` | Controls primary versus secondary action presentation; secondary actions appear in an overflow menu. Valid values: `"primary"`, `"secondary"`. | 1.5 |
| `requires` | `object` | `{}` | Capabilities required from the host; if unsupported, the element isn't rendered or its fallback is used. Valid value: `HostCapabilities`. | 1.2 |
| `style` | `string` | `"default"` | Controls visual and spoken representations of the action. Valid values: `"default"`, `"positive"`, `"destructive"`. | 1.2 |
| `themedIconUrls` | Array of `object` | — | **Teams.** Theme-specific icon URLs. Valid value: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | Array of `object` | — | **Preview.** Theme-specific icon URLs for the toggled state, applicable only when `behavior` is `Toggle`. Valid value: `ThemedUrl`. | 1.5 |
| `title` | `string` | — | Action title shown on buttons. | 1.0 |
| `title.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `title`. | 1.5 |
| `title.toggled` | `string` | — | **Preview.** Title shown in toggled state; applies only when `behavior` is `Toggle`. | 1.5 |
| `tooltip` | `string` | — | Tooltip shown when hovering over the action. | 1.5 |
| `tooltip.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `tooltip`. | 1.5 |
| `tooltip.toggled` | `string` | — | **Preview.** Tooltip shown in toggled state; applies only when `behavior` is `Toggle`. | 1.5 |
