# CompoundButton

**Works in:** Teams

A special type of button with an icon, title and description.

## Example

### Card JSON

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "layouts": [
    {
      "type": "Layout.Flow",
      "itemWidth": "200px",
      "itemFit": "Fill",
      "minItemWidth": "0px"
    }
  ],
  "body": [
    {
      "type": "CompoundButton",
      "title": "Summarize",
      "height": "stretch",
      "icon": {
        "name": "TextBulletList"
      },
      "description": "Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt..."
    },
    {
      "type": "CompoundButton",
      "title": "Insights",
      "description": "Who's reviewed my latest document?",
      "height": "stretch",
      "icon": {
        "name": "Lightbulb"
      }
    },
    {
      "type": "CompoundButton",
      "title": "Get key info",
      "description": "List key points from my latest document",
      "badge": "New",
      "height": "stretch"
    },
    {
      "type": "CompoundButton",
      "title": "Share meeting notes",
      "description": "Draft an email with notes and action items from my latest meeting",
      "height": "stretch",
      "icon": {
        "name": "Calendar"
      }
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `CompoundButton`. | 1.0 |
| `badge` | string | — | The badge to show on the button. | 1.5 |
| `description` | string | — | The description text of the button. | 1.5 |
| `icon` | object | — | The icon to show on the button. Valid value: `IconInfo`. | 1.5 |
| `selectAction` | object | — | An Action that will be invoked when the button is tapped or clicked. `Action.ShowCard` is not supported. See valid actions below. | 1.5 |
| `title` | string | — | The title of the button. | 1.5 |
| `fallback` | object or string | — | An alternate element to render if this type is unsupported or the host does not support all required capabilities. See valid fallback values below. | 1.2 |
| `grid.area` | string | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | string | `"auto"` | The height of the element. `stretch` uses the remaining vertical space in its container. Valid: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | string | — | Controls horizontal alignment. Valid: `Left`, `Center`, `Right`. | 1.0 |
| `id` | string | — | Unique identifier for the element or action. Input elements must have an ID to be validated and have values sent to the Bot. | 1.0 |
| `isSortKey` | boolean | `false` | Controls whether the element is used as a sort key by elements that sort collections. | 1.5 |
| `isVisible` | boolean | `true` | Controls visibility of the element. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | string | — | Optional key; can help maintain visual state in the host application. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `requires` | object | `{}` | Required host capabilities; if unsupported, the element is not rendered (or its fallback is rendered). Valid: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Displays a separator above the element, except for the first element in a container. | 1.0 |
| `spacing` | string | `"Default"` | Amount of space between this element and the previous element; none is added for the first element. See valid values below. | 1.0 |
| `targetWidth` | string | — | **TeamsCopilot.** Controls which card widths render the element; when omitted, it renders at all widths. See valid values below. | 1.0 |

### Valid values

#### `selectAction`

- `Action.Execute`
- `Action.InsertImage`
- `Action.OpenUrl`
- `Action.OpenUrlDialog`
- `Action.Popover`
- `Action.ResetInputs`
- `Action.RunCommands`
- `Action.Submit`
- `Action.ToggleVisibility`

#### `fallback`

- `Container`
- `ActionSet`
- `ColumnSet`
- `Media`
- `RichTextBlock`
- `Table`
- `TextBlock`
- `FactSet`
- `ImageSet`
- `Image`
- `Input.Text`
- `Input.Date`
- `Input.Time`
- `Input.Number`
- `Input.Toggle`
- `Input.ChoiceSet`
- `Input.Rating`
- `Rating`
- `CompoundButton`
- `Icon`
- `Carousel`
- `TabSet`
- `Accordion`
- `Badge`
- `ProgressRing`
- `ProgressBar`
- `LoopComponent`
- `Chart.Donut`
- `Chart.Pie`
- `Chart.VerticalBar.Grouped`
- `Chart.VerticalBar`
- `Chart.HorizontalBar`
- `Chart.HorizontalBar.Stacked`
- `Chart.Line`
- `Chart.Gauge`
- `CodeBlock`
- `Persona`
- `PersonaSet`
- `Graph resource`
- `File`
- `Calendar event`
- `"drop"`

#### `spacing`

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`

#### `targetWidth`

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`
