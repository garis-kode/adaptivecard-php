# Media

**Works in:** Teams · Copilot · Outlook

A media element that makes it possible to embed videos inside a card.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Media",
      "sources": [
        {
          "url": "https://www.youtube.com/watch?v=YsqcODOEO-M",
          "mimeType": "video/mp4"
        }
      ]
    },
    {
      "type": "TextBlock",
      "text": "Telegraph Road - Dire Straits",
      "size": "Large",
      "weight": "Bolder",
      "wrap": true
    },
    {
      "type": "TextBlock",
      "spacing": "None",
      "text": "Cover by David Claux",
      "wrap": true
    }
  ]
}
```

> **Important:** For YouTube, Vimeo, and Dailymotion videos, set the media source's `mimeType` to `video/mp4` as in the example below. (The source text calls this `contentType`, while its JSON uses `mimeType`.)

```json
"sources": [
  {
    "url": "https://www.youtube.com/watch?v=YsqcODOEO-M",
    "mimeType": "video/mp4"
  }
]
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Media`. | 1.0 |
| `altText` | `string` | — | Alternate text for accessibility. | 1.1 |
| `captionSources` | `array of objects` | — | Caption sources for the media. Not used for YouTube, Dailymotion, or Vimeo sources. Valid value: `CaptionSource`. | 1.6 |
| `fallback` | `object or string` | — | Alternate element if the element or required capabilities are unsupported. See supported fallback values below. | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area in a `Layout.AreaGrid` layout where the element is displayed. | 1.5 |
| `height` | `string` | `"auto"` | Height of the element; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements must have an ID to be validated and sent to the bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key by collections that support sorting. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key, occasionally useful for maintaining visual state. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `poster` | `string` | — | URL of the poster image to display. | 1.1 |
| `requires` | `object` | `{}` | Required host capabilities. If unsupported, the element is not rendered or its fallback is rendered. Valid value: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Displays a separator above the element, except when first in a container. | 1.0 |
| `sources` | `array of objects` | — | Media sources. Only one source can be specified for YouTube, Dailymotion, and Vimeo. Valid value: `MediaSource`. | 1.1 |
| `spacing` | `string` | `"Default"` | Space between this and preceding element; none for the first element. See values below. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Restricts which card widths display the element; unspecified means all widths. See values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `spacing` values

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.

---

## MediaSource

**Works in:** Teams · Copilot · Outlook

Defines the source URL of a media stream. YouTube, Dailymotion, Vimeo, and Microsoft Stream URLs are supported.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `key` | `string` | — | Optional object key, occasionally useful for maintaining visual state. | 1.0 |
| `mimeType` | `string` | — | MIME type of the source. | 1.1 |
| `url` | `string` | — | URL of the source. | 1.1 |

---

## CaptionSource

**Works in:** Teams · Copilot · Outlook

Defines a source URL for video captions.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `label` | `string` | — | Label of the caption source. | 1.6 |
| `key` | `string` | — | Optional object key, occasionally useful for maintaining visual state. | 1.0 |
| `mimeType` | `string` | — | MIME type of the source. | 1.1 |
| `url` | `string` | — | URL of the source. | 1.1 |
