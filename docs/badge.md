# Badge

**Works in:** Teams

A badge element to show an icon and/or text in a compact form over a colored background.

## Card example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Shapes",
      "wrap": true
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "Circular",
          "size": "Large",
          "style": "Accent"
        },
        {
          "type": "Badge",
          "text": "Rounded",
          "size": "Large",
          "style": "Accent",
          "shape": "Rounded"
        },
        {
          "type": "Badge",
          "text": "Square",
          "size": "Large",
          "style": "Accent",
          "shape": "Square"
        }
      ]
    },
    {
      "type": "TextBlock",
      "text": "Sizes",
      "wrap": true,
      "separator": true,
      "spacing": "ExtraLarge"
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "Extra large no icon",
          "size": "ExtraLarge"
        },
        {
          "type": "Badge",
          "text": "Extra large with icon",
          "size": "ExtraLarge",
          "icon": "Calendar"
        },
        {
          "type": "Badge",
          "text": "Extra large with icon on right",
          "size": "ExtraLarge",
          "icon": "Calendar",
          "iconPosition": "After"
        },
        {
          "type": "Badge",
          "size": "ExtraLarge",
          "icon": "Calendar"
        }
      ]
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "Large no icon",
          "size": "Large"
        },
        {
          "type": "Badge",
          "text": "Large with icon",
          "size": "Large",
          "icon": "Calendar"
        },
        {
          "type": "Badge",
          "text": "Large with icon on right",
          "size": "Large",
          "icon": "Calendar",
          "iconPosition": "After"
        },
        {
          "type": "Badge",
          "size": "Large",
          "icon": "Calendar"
        }
      ],
      "spacing": "Large"
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "Medium no icon"
        },
        {
          "type": "Badge",
          "text": "Medium with icon",
          "icon": "Calendar"
        },
        {
          "type": "Badge",
          "text": "Medium with icon on right",
          "icon": "Calendar",
          "iconPosition": "After"
        },
        {
          "type": "Badge",
          "icon": "Calendar"
        }
      ],
      "spacing": "Large"
    },
    {
      "type": "TextBlock",
      "text": "Styles and colors",
      "wrap": true,
      "separator": true,
      "spacing": "ExtraLarge"
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "Default filled",
          "size": "Large"
        },
        {
          "type": "Badge",
          "text": "Default tint",
          "size": "Large",
          "appearance": "Tint"
        },
        {
          "type": "Badge",
          "text": "Informative filled",
          "size": "Large",
          "style": "Informative"
        },
        {
          "type": "Badge",
          "text": "Informative tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Informative"
        },
        {
          "type": "Badge",
          "text": "Accent filled",
          "size": "Large",
          "style": "Accent"
        },
        {
          "type": "Badge",
          "text": "Accent tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Accent"
        },
        {
          "type": "Badge",
          "text": "Good filled",
          "size": "Large",
          "style": "Good"
        },
        {
          "type": "Badge",
          "text": "Good tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Good"
        },
        {
          "type": "Badge",
          "text": "Attention filled",
          "size": "Large",
          "style": "Attention"
        },
        {
          "type": "Badge",
          "text": "Attention tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Attention"
        },
        {
          "type": "Badge",
          "text": "Warning filled",
          "size": "Large",
          "style": "Warning"
        },
        {
          "type": "Badge",
          "text": "Warning tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Warning"
        },
        {
          "type": "Badge",
          "text": "Subtle filled",
          "size": "Large",
          "style": "Subtle"
        },
        {
          "type": "Badge",
          "text": "Subtle tint",
          "size": "Large",
          "appearance": "Tint",
          "style": "Subtle"
        }
      ]
    },
    {
      "type": "TextBlock",
      "text": "With tooltip",
      "wrap": true,
      "separator": true,
      "spacing": "ExtraLarge"
    },
    {
      "type": "Container",
      "layouts": [
        {
          "type": "Layout.Flow",
          "horizontalItemsAlignment": "Left",
          "minItemWidth": "0px"
        }
      ],
      "items": [
        {
          "type": "Badge",
          "text": "With tooltip",
          "tooltip": "This is the tooltip",
          "size": "Large"
        },
        {
          "type": "Badge",
          "tooltip": "This is the tooltip",
          "size": "Large",
          "icon": "Calendar"
        }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| type | string | — | Must be `Badge`. | 1.0 |
| appearance | string | `"Filled"` | Controls background color strength. Values: `Filled`, `Tint`. | 1.5 |
| icon | string | — | Adaptive Card icon catalog name, format `<icon-name>[,regular|filled]`. Default icon style is regular. | 1.5 |
| iconPosition | string | `"Before"` | Icon placement: `Before`, `After`. | 1.5 |
| shape | string | `"Circular"` | Badge shape: `Square`, `Rounded`, `Circular`. | 1.5 |
| size | string | `"Medium"` | Badge size: `Medium`, `Large`, `ExtraLarge`. | 1.5 |
| style | string | `"Default"` | Badge style: `Default`, `Subtle`, `Informative`, `Accent`, `Good`, `Attention`, `Warning`. | 1.5 |
| text | string | — | Text to display. | 1.5 |
| tooltip | string | — | Tooltip displayed when hovering over the badge. | 1.5 |
| fallback | object or string | — | Alternate element if unsupported or required capabilities are unavailable. See valid values below. | 1.2 |
| grid.area | string | — | Area in a `Layout.AreaGrid` layout. Teams. | 1.5 |
| height | string | `"auto"` | Height: `auto`, `stretch`. Stretch uses remaining container space. | 1.1 |
| horizontalAlignment | string | — | Horizontal alignment: `Left`, `Center`, `Right`. | 1.0 |
| id | string | — | Unique element/action ID. Inputs require an ID for validation and submission to the bot. | 1.0 |
| isSortKey | boolean | `false` | Whether the element is a sort key for sortable collections. | 1.5 |
| isVisible | boolean | `true` | Controls element visibility. | 1.2 |
| isVisible.dynamic | string | — | Preview: runtime expression used to update `isVisible`. | 1.5 |
| key | string | — | Optional object key that can help retain visual state. | 1.0 |
| lang | string | — | Locale associated with the element. | 1.1 |
| requires | object | `{}` | Required host capabilities. If unmet, fallback renders if supplied. Valid value: `HostCapabilities`. | 1.2 |
| separator | boolean | `false` | Show a separator above the element (not shown for first item in a container). | 1.0 |
| spacing | string | `"Default"` | Spacing before element: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| targetWidth | string | — | Responsive width target. See valid values below. Teams/Copilot. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
