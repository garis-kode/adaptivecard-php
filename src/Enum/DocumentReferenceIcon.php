<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum DocumentReferenceIcon: string
{
    case MsWord = 'msWord';
    case MsExcel = 'msExcel';
    case MsPowerPoint = 'msPowerPoint';
    case MsOneNote = 'msOneNote';
    case MsSharePoint = 'msSharePoint';
    case MsVisio = 'msVisio';
    case MsLoop = 'msLoop';
    case MsWhiteboard = 'msWhiteboard';
    case Code = 'code';
    case Sketch = 'sketch';
    case AdobeIllustrator = 'adobeIllustrator';
    case AdobePhotoshop = 'adobePhotoshop';
    case AdobeInDesign = 'adobeInDesign';
    case AdobeFlash = 'adobeFlash';
    case Image = 'image';
    case Gif = 'gif';
    case Video = 'video';
    case Sound = 'sound';
    case Zip = 'zip';
    case Text = 'text';
    case Pdf = 'pdf';
}
