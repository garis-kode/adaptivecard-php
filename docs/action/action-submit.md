# Action.Submit

**Works in:** Teams · Copilot

Gathers input values, merges them with the `data` property if specified, and sends them to the Bot via an Invoke activity. The Bot can only acknowledge it has received the request.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `Action.Submit`. | 1.0 |
| `msteams` | object | — | Teams-specific metadata associated with the action. Valid value: `TeamsSubmitActionProperties`. | 1.0 |
| `msTeams` | object | — | Teams-specific metadata associated with the action. Equivalent to `msteams`. Valid value: `TeamsSubmitActionProperties`. | 1.0 |
| `associatedInputs` | string | — | The IDs of the inputs associated with the Action.Submit. When executed, values of the associated inputs are sent to the Bot. See Input validation for details. **Valid values:** `auto`, `none`. | 1.3 |
| `behavior` | string | `Default` | **Preview.** Controls action behavior. `Toggle` alternates between normal and toggled states each time the action executes. **Valid values:** `Default`, `Toggle`. | 1.5 |
| `conditionallyEnabled` | boolean | `false` | **Teams.** Enables the action only if at least one required input has been filled. | 1.5 |
| `data` | string or object | — | The data sent to the Bot. An object is merged with input values as key/value pairs keyed by input ID. A string prevents input values from being sent. Valid value: `SubmitActionData`. | 1.0 |
| `fallback` | object or string | — | Alternate action to render if unsupported or if required capabilities are unavailable. **Valid values:** `Action.Submit`, `Action.OpenUrl`, `Action.Execute`, `Action.ToggleVisibility`, `Action.ShowCard`, `Action.ResetInputs`, `Action.Popover`, `Action.OpenUrlDialog`, `Action.InsertImage`, `Action.RunCommands`, `drop`. | 1.2 |
| `iconUrl` | string | — | URL or Base64 Data URI for a PNG, GIF, JPEG, or SVG icon to the left of the title. Also supports `icon:&lt;icon-name&gt;[,regular\|filled]`, such as `icon:Calendar` or `icon:Calendar,filled`. | 1.1 |
| `iconUrl.toggled` | string | — | **Preview.** Icon URL in the toggled state; same formats as `iconUrl`. Only applies with `behavior: Toggle`. | 1.5 |
| `id` | string | — | Unique identifier for the element/action. Inputs must have an `id` to be validated and sent to the Bot. | 1.0 |
| `initialState` | string | `Normal` | **Preview.** Initial toggle state; only when `behavior` is `Toggle`. **Valid values:** `Normal`, `Toggled`. | 1.5 |
| `isEnabled` | boolean | `true` | Enables or disables the action. Disabled actions cannot be clicked; buttons visually reflect the disabled state. | 1.5 |
| `isEnabled.dynamic` | string | — | **Preview.** Expression evaluated at runtime to update `isEnabled`. | 1.5 |
| `isVisible` | boolean | `true` | **Preview.** Controls action visibility. | 1.5 |
| `isVisible.dynamic` | string | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `menuActions` | array of object | — | **Teams.** Actions shown in a Split action button overflow menu. **Valid values:** `Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`. | 1.5 |
| `mode` | string | `primary` | Controls whether action is primary or secondary; secondary actions appear in an overflow menu. **Valid values:** `primary`, `secondary`. | 1.5 |
| `requires` | object | `{}` | Capabilities required of the host. If unavailable, action is not rendered, or fallback is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `style` | string | `default` | Controls the visual and spoken representations of the action. **Valid values:** `default`, `positive`, `destructive`. | 1.2 |
| `themedIconUrls` | array of object | — | **Teams.** Theme-specific icon URLs. Valid value: `ThemedUrl`. | 1.5 |
| `themedIconUrls.toggled` | array of object | — | **Preview.** Theme-specific icon URLs for the toggled state; only when behavior is `Toggle`. Valid value: `ThemedUrl`. | 1.5 |
| `title` | string | — | Title of the action as shown on buttons. | 1.0 |
| `title.dynamic` | string | — | **Preview.** Runtime expression updating the action title. | 1.5 |
| `title.toggled` | string | — | **Preview.** Title in toggled state, only when behavior is `Toggle`. | 1.5 |
| `tooltip` | string | — | Tooltip displayed on hover. | 1.5 |
| `tooltip.dynamic` | string | — | **Preview.** Runtime expression updating the tooltip. | 1.5 |
| `tooltip.toggled` | string | — | **Preview.** Tooltip displayed in toggled state, only when behavior is `Toggle`. | 1.5 |

---

## TeamsSubmitActionProperties

**Works in:** Teams · Copilot · Outlook

Teams-specific properties associated with the action.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `feedback` | object | — | Defines how feedback is provided to the end-user when the action is executed. Valid value: `TeamsSubmitActionFeedback`. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## TeamsSubmitActionFeedback

**Works in:** Teams · Copilot · Outlook

Represents feedback options for an `Action.Submit`.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `hide` | boolean | — | Defines if a feedback message should be displayed after the action is executed. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## ImBackSubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents Teams-specific data in an `Action.Submit` to send an Instant Message back to the Bot.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `imBack`. | 1.0 |
| `value` | string | — | The value that will be sent to the Bot. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## MessageBackSubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents Teams-specific data in an `Action.Submit` to send a message back to the Bot.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `messageBack`. | 1.0 |
| `displayText` | string | — | Optional text displayed as a new conversation message as if the user sent it; not sent to the Bot. | 1.0 |
| `text` | string | — | Text sent to the Bot. | 1.0 |
| `value` | any | — | Optional additional value sent to the Bot; may encode context such as identifiers or a JSON object. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## InvokeSubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents Teams-specific data in an `Action.Submit` to make an Invoke request to the Bot.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `invoke`. | 1.0 |
| `value` | any or object | — | Object sent with the Invoke request. Can be strongly typed to trigger specific Teams actions. Valid value: `CollabStageInvokeDataValue`. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## TaskFetchSubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents Teams-specific data in an `Action.Submit` to open a task module.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `task/fetch`. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## SigninSubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents Teams-specific data in an `Action.Submit` to sign in a user.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `signin`. | 1.0 |
| `value` | string | — | URL to redirect the end-user for signing in. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |

---

## CollabStageInvokeDataValue

**Works in:** Teams · Copilot · Outlook

Data for invoking a collaboration stage action.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `tab/tabInfoAction`. | — |
| `tabInfo` | object | — | Information about the iFrame content rendered in the collaboration stage popout window. Valid value: `TabInfo`. | — |

---

## SubmitActionData

**Works in:** Teams · Copilot · Outlook

Represents the data of an `Action.Submit`.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `msteams` | object | — | Optional Teams-specific portion of action data. Valid values: `ImBackSubmitActionData`, `InvokeSubmitActionData`, `MessageBackSubmitActionData`, `SigninSubmitActionData`, `TaskFetchSubmitActionData`. | 1.0 |
| `msTeams` | object | — | Optional Teams-specific portion of action data; equivalent to `msteams`. Valid values: `ImBackSubmitActionData`, `InvokeSubmitActionData`, `MessageBackSubmitActionData`, `SigninSubmitActionData`, `TaskFetchSubmitActionData`. | 1.0 |
| `key` | string | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `[key: string]` | any | — | Additional arbitrary data properties. | — |
