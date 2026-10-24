# Image

**Works in:** Teams, Copilot, Outlook

A standalone image element.

## Card example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "layouts": [
    { "type": "Layout.Flow", "horizontalItemsAlignment": "Left" }
  ],
  "body": [
    { "type": "Image", "url": "images/guitar1.jpeg", "width": "128px", "altText": "An electric guitar" },
    { "type": "Image", "url": "images/guitar2.jpeg", "width": "128px", "style": "RoundedCorners", "altText": "An electric guitar" },
    { "type": "Image", "url": "images/guitar3.jpeg", "width": "128px", "style": "Person", "altText": "An electric guitar" }
  ]
}
```

> **Tip:** If you need to overlay content on top of an image, use a `Container` with a background image.

> **Important:** When using explicit dimensions in pixels, maintain the image's aspect ratio.

- If you set both width and height in pixels, use dimensions that maintain the image's aspect ratio. In most cases, set either width or height, but not both, so the other dimension is automatically calculated.
- Prefer setting width over height, especially for landscape images, to control the horizontal space used.
- In general, use explicit pixel dimensions only for small images such as avatars or thumbnails.
- Make your card responsive so images look good on any screen and device.
- Always set `altText` for accessibility and screen readers.

## Base64-encoded images

You can use Base64-encoded Data URIs as image URLs to fully embed your images in an Adaptive Card:

```json
{
  "type": "Image",
  "url": "data:image/png;base64,<base64-encoded bytes of the image>"
}
```

### Example

The provided example uses an `AdaptiveCard` version `1.0` containing an `Image` with a long, inline, PNG Data URI. The Base64 binary payload is not reproduced below; replace the placeholder with the original source's encoded bytes to reconstruct that exact example.

```json
{
  "version": "1.0",
  "type": "AdaptiveCard",
  "body": [
    {
      "type": "Image",
      "url": "data:image/png;base64,<full PNG Base64 payload>"
    }
  ]
}
```

> **Tip:** For large images, favor public URLs over Base64-encoded images. Base64 significantly increases Adaptive Card payload size, network transfer, and loading time.

## Image schema

| Name | Type | Default | Description | In version |
|---|---|---|---|---|
| `type` | string | — | Must be `Image`. | 1.0 |
| `allowExpand` | boolean | `false` | Controls whether the image can expand to full screen. | 1.2 |
| `altText` | string | — | Alternate text used for accessibility. | 1.0 |
| `backgroundColor` | string | — | Background color in `#RRGGBB` or `#AARRGGBB` format. | 1.1 |
| `fitMode` | string | `Fill` | **Teams.** How to fit an image within a bounding box; relevant only when both width and height are set. `Contain` always uses the default style. Values: `Cover`, `Contain`, `Fill`. | 1.5 |
| `height` | string | `auto` | Image height. Values: `auto`, `stretch`, `<number>px`. | 1.1 |
| `horizontalContentAlignment` | string | `Left` | **Teams.** Horizontal position inside the image bounding box, meaningful when width and height are set and `fitMode` is `Cover` or `Contain`. Values: `Left`, `Center`, `Right`. | 1.5 |
| `msteams` | object | — | **Teams.** Teams-specific image metadata; value: `TeamsImageProperties`. | 1.2 |
| `msTeams` | object | — | Teams-specific metadata, equivalent to `msteams`; value: `TeamsImageProperties`. | 1.2 |
| `selectAction` | object | — | Action invoked when clicked/tapped; `Action.ShowCard` is not supported. See valid actions below. | 1.1 |
| `size` | string | `Auto` | Values: `Auto`, `Stretch`, `Small`, `Medium`, `Large`. | 1.0 |
| `style` | string | `Default` | Values: `Default`, `Person`, `RoundedCorners` (**Teams**). | 1.0 |
| `themedUrls` | array of objects | — | **Teams.** Theme-specific image URLs; values: `ThemedUrl`. | 1.5 |
| `url` | string | — | Image URL or Base64 Data URI; supports PNG, JPEG, GIF, SVG. | 1.0 |
| `verticalContentAlignment` | string | `Top` | **Teams.** Vertical position within bounding box when both dimensions are set and `fitMode` is `Cover` or `Contain`. Values: `Top`, `Center`, `Bottom`. | 1.5 |
| `width` | string | `auto` | Values: `auto`, `stretch`, `<number>px`. | 1.1 |
| `fallback` | object or string | — | Alternative element if unsupported or capabilities not met. See valid fallback elements below. | 1.2 |
| `grid.area` | string | — | **Teams.** Area in a `Layout.AreaGrid`. | 1.5 |
| `horizontalAlignment` | string | — | Values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | string | — | Unique identifier for element/action. Input elements require an ID for validation and sending values to a bot. | 1.0 |
| `isSortKey` | boolean | `false` | Whether this element is used as a sort key in sortable collections. | 1.5 |
| `isVisible` | boolean | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview.** Expression evaluated at runtime to update visibility. | 1.5 |
| `key` | string | — | Optional object key; occasionally useful to preserve visual state. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `requires` | object | `{}` | Required host capabilities; unsupported requirements prevent rendering unless fallback is provided. Value: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Shows a separator above the element, except for the first item in a container. | 1.0 |
| `spacing` | string | `Default` | Spacing from the previous element; no extra space before the first element in a container. See valid spacing values below. | 1.0 |
| `targetWidth` | string | — | **Teams/Copilot.** Responsive card-width condition; unspecified means all widths. See valid values below. | 1.0 |

### Valid `selectAction` values

- `Action.Execute`
- `Action.InsertImage`
- `Action.OpenUrl`
- `Action.OpenUrlDialog`
- `Action.Popover`
- `Action.ResetInputs`
- `Action.RunCommands`
- `Action.Submit`
- `Action.ToggleVisibility`

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `spacing` values

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.

---

# TeamsImageProperties

**Works in:** Teams, Copilot, Outlook

Represents a set of Teams-specific properties on an image.

## Schema

| Name | Type | Default | Description | In version |
|---|---|---|---|---|
| `allowExpand` | boolean | — | Controls whether the image is expandable in Teams. Equivalent to `Image.allowExpand`. | 1.0 |
| `key` | string | — | Optional object key, rarely needed except to help maintain visual state in some scenarios. | 1.0 |
