# MusicNotes API

zSnout's MusicNotes API is an easy way to make musical scales and chords without having to write much code.

Ready to start using MusicNotes API? Let's get started!

## We Support...

Currently MusicNotes API is only supported PHP. If you would like to help add support in other languages, please create a pull request.

## Including MusicNotes API

To include MusicNotes, you can either:

 1. Download and serve MusicNotes yourself. If you choose this option, download [this file](https://github.com/zSnout/MusicNotes-API/blob/master/musicnotes.php).
 2. Send requests to zSnout's server.

## Writing Queries

MusicNotes queries are meant to be simple, easy-to-understand things. Here's how to write them.

MusicNotes queries come in three parts: the base note (the base note of the scale), the scale type (major, minor, augmented, diminished), and the note number (we're getting the nth note in the scale).

#### The Base Note

A base note consists of two parts: the note and a modifier. For example, in this base note: `Csharp`, the note is `C` and the modifier is `sharp`.

The note can be `A`, `B`, `C`, `D`, `E`, `F`, or `G`, and the modifier can be `flat`, `sharp`, or omitted. You can also use `b` as an alias for `flat`.

To get our base note, simply stick the note and the modifier together, like in these examples: `A` (note A, modifier omitted), `Bb` (note B, modifier b).

Always make sure to capitalize your note so that it gets interpreted correctly.
