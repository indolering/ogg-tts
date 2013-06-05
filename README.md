# Ogg TTS

A Javascript API and a PHP proxy to convert the MP3s produced by Google's Text To Speech "service" to Firefox compatible OGG files.

## Features

* Converts upto 42 languages
* Supports playback through [HTML5 Audio tag](https://developer.mozilla.org/En/HTML/Element/Audio) if available in browser.
* Asynchronous playback API
* Small and compact: ~1 KB minified and gzipped

## Installation

Add the following inside your HTML `<body>` tag, near the bottom:

    <script type="text/javascript" src="https://raw.github.com/hiddentao/google-tts/master/ogg-tts.min.js"></script>

## API

### new GoogleTTS(language)

Initialize a new instance of the library, e.g:

    var tts = new oggTTS('zh-CN');

**Params:**

  * `language` - the default language to speak in when not otherwise specified. If omitted then English is assumed.


### .languages()

Get the full list of supported languages.

**Returns:** An object such as:

    {
        ...
        'en' : 'English',
        'zh-CN' : 'Mandarin (simplified)',
        ...
    }

### .canPlay()

Get whether the Text-to-Speech audio can be played by the browser.

**Returns:** `true` if so, `false` otherwise.

### .url(text, language)

Construct the URL to fetch the speech audio for given text and language.

**Params:**

  * `text` - the text to convert to speech.
  * `language` - the language to speak it in. If omitted then the default language (see above) is assumed.

**Returns:** a URL to the audio file.

### .play(text, language, cb)

Fetch and play the speech audio for given text and language, if possible (see top).

**Params:**

  * `text` - the text to convert to speech.
  * `language` - the language to speak it in. If omitted then the default language (see above) is assumed.
  * `cb` - Completion callback function with signature `(err)`, where `err` holds information on any errors which may occur.

## Demo

Checkout the code and double-click `index.html`.

## License

 Copyright (C) 2013  Zachary Lym

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
