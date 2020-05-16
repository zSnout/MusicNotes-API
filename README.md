# MusicNotes API

zSnout's MusicNotes API is an easy way to make musical scales and chords without having to write much code.

Ready to start using MusicNotes API? Let's get started!

## We Support...

Currently MusicNotes API in only written in PHP. If you would like to help add support in other languages, please create a pull request.

## Including The MusicNotes API

To include MusicNotes, you can either:

 1. Download and serve MusicNotes yourself. If you choose this option, download [this file](https://github.com/zSnout/MusicNotes-API/blob/master/musicnotes.php).
 2. Send requests to zSnout's server.

When you send a request, it should look something like this:

```
http://yourdomain.com/path/to/file?(query)
```

or

```
https://zsnout.com/note?(query)
```

Remember, your query should be a query written in the format described below, or several queries joined together with `,`, `?`, `&`, or `:`.

## Writing Queries

MusicNotes queries are meant to be simple, easy-to-understand things. Here's how to write them.

MusicNotes queries come in three parts: the base note (the base note of the scale), the scale type (major, minor, augmented, diminished), and the note number (we're getting the nth note in the scale).

#### The Base Note

A base note consists of two parts: the note and a modifier. For example, in this base note: `Csharp`, the note is `C` and the modifier is `sharp`.

The note can be `A`, `B`, `C`, `D`, `E`, `F`, or `G`, and the modifier can be `flat`, `sharp`, or omitted. You can also use `b` as an alias for `flat`.

To get our base note, simply stick the note and the modifier together, like in these examples: `A` (note A, modifier omitted), `Bb` (note B, modifier b).

Always make sure to capitalize your note so that it gets interpreted correctly.

Here's a summary of what we've written here in diagram form:

![](/assets/base-note.svg)

#### The Scale Type

The scale type tells the interpreter which note to output. There are several different types of scales, but MusicNotes supports two common scales, and two less common scales.

These are the major scale, the minor scale, the augmented scale, and the diminished scale.

To specify the scale type, simply write `maj` for major, `min` for minor, `aug` for augmented, and `dim` for diminished. You can also omit it to specify major.

Here's a diagram of the above conditions:

![](/assets/scale-type.svg)

#### The Note Number

The note number can take 4 different forms. Here they are:

###### Empty

If you omit the note number, the query will select the entire scale. Remember that major and minor sclaes are 8 notes long, augmented scales are 7 notes long, and diminished scales are 9 notes long.

But what if we only want to get the third note?

###### Specific Numbers

The last part of a query is the note number. Without it, an entire scale is selected, which may not be what you wanted to get.

The note number can be anything from `0` to `9`, where notes `0` and `1` are equivalent.

For example, we could write `4` or `6`.

But what if we want the first, third, fifth, seventh, and ninth notes in a scale?
