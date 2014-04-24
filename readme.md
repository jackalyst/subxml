# function subxml

Based loosely on the implementation of substr(), but instead of a string it's able to take the inner text of HTML/XML and truncate that instead. It's useful for trimming 

## Overview

There are three parameters

```php
@param string
	The input string/xml.
@param int
	The length to trim.
@param string (optional)
	Boundary type ['char', 'sentence', 'word']
	Default 'char'
```

## Usage

The default is to truncate the inner XML to a set *character length*.

```php
$string = "<p>This is a long string</p>";
$string = subxml($string, 4);
echo $string; // Result: <p>This</p>
```

The other is to truncate it to a *word length*.

```php
$string = "<p>This is a long string</p>";
$string = subxml($string, 2, 'word');
echo $string; // Result: <p>This is</p>
```

And how about to *sentence length*?

```php
$string = "<p>This is a long string!! With multiple sentences.</p>";
$string = subxml($string, 1, 'sentence');
echo $string; // Result: <p>This is a long string!!</p>
```

## Todo

- Don't trim script and style's.