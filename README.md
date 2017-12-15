# Extract text from an epub

This package provides a class to extract text from an epub.

```php
 \jove4015\epub2txt\Epub::getText('book.epub'); //returns the text from the epub
```



## Requirements

Behind the scenes this package leverages [epub2txt](https://github.com/kevinboone/epub2txt2). You can verify if the binary installed on your system by issueing this command:
```
which epub2txt
```

If it is installed it will return the path to the binary.

To install the binary you can follow the instructions here: (http://kevinboone.net/README_epub2txt.html)

## Installation

You can install the package via composer:
```bash
$ composer require jove4015/epub-to-text
```

## Usage

Extracting text from an epub is easy.

```php
$text = (new epub())
    ->setepub('book.epub')
    ->text();
```

Or easier:

```php
 \jove4015\EpubToText\epub::getText('book.epub')
```

By default the package will assume that the `epub2txt` is located at `/usr/bin/epub2txt`.
If you're using the a different location pass the path to the binary in constructor
```php
$text = (new epub('/custom/path/to/epub2txt'))
    ->setepub('book.epub')
    ->text();
```

or as the second parameter to the `getText`-function:
```php
 \jove4015\EpubToText\epub::getText('book.epub', '/custom/path/to/epub2txt')
```

## Testing

``` bash
$ composer test
```

## Credits

- [Freek Van der Herten](https://github.com/freekmurze) - Wrote the original [pdf-to-text](https://github.com/spatie/pdf-to-text) package on which this is based
- [Kevin Boone](https://github.com/kevinboone) - Wrote the epub2txt CLI utility

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
