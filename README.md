# keepachangelog-parser

Parser for the Keep A Changelog standard.

## Requirements

This package requires at least PHP 8.1 or newer.

## Installation

You can install the package via composer:

`composer require vdhicts/keepachangelog-parser`

## Usage

This package is intended to be easy to use. 

### Parsing the changelog

```php
$content = file_get_contents('CHANGELOG.md');

$parser = new \Vdhicts\KeepAChangelog\Parser();
$changelog = $parser->parse($content);
```

### Using a different date format

The parser will parse the releases with the `Y-m-d` format by default.
If you would like to use another format, you can just pass the format to the `setDateFormat` function.

```php
$content = file_get_contents('CHANGELOG.md');

$parser = new \Vdhicts\KeepAChangelog\Parser();
$changelog = $parser
    ->setDateFormat('Y-m-d H:i:s')
    ->parse($content);
```

### Accessing the changelog

The parser will return a `Changelog` models, with contains a collection of `Release` models. The `Release` model 
contains a collection of `Section` models.

The changelog has several methods the retrieve information:

```php
// Get the description of the changelog, which returns an array of lines
$descriptionHtml = implode('<br>', $changelog->getDescription());

// Determine if the changelog has any releases
$changelog->hasReleases();

// Get the unreleased section
$unreleased = $changelog->getUnreleased();

// Get the latest release
$latestRelease = $changelog->getLatestRelease();
```

When all releases are retrieved, the newest will be the first and the unreleased will be the last one when present.

The release has several methods to get information about the release:

```php
// Determine if the current one is the unreleased section
$isUnreleased = $release->isUnreleased();

// Get the version for the release
$version = $release->getVersion();

// Get the release date, will be null when not released or a date isn't provided
$data = $release->getReleasedAt();

// Get the tag reference, usually something like https://github.com/vdhicts/keepachangelog-parser/compare/v0.0.1...v1.0.0
$tagReference = $release->getTagReference();

// Get a specific section of the release
$added = $release->getSection(Section::ADDED);

// Get the collection of sections for the release
$sections = $release->getSections();
```

The section consists of a type (like Added, etc.) and an array of entries:

```php
$type = $section->getType();
$entries = $section->getEntries();

$entriesHtml = implode('<br>', $entries);
```

## Tests

Unit tests are available in the `tests` folder. Run with:

`composer test`

When you want a code coverage report which will be generated in the `build/report` folder. Run with:

`composer test-coverage`

## Contribution

Any contribution is welcome, but it should meet the PSR-12 standard and please create one pull request per feature/bug.
In exchange, you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email security@vdhicts.nl 
instead of using the issue tracker.

## Support

If you encounter a problem with this parser or has a question about it, feel free to open an issue on GitHub.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## About Vdhicts

[Vdhicts](https://www.vdhicts.nl) is the name of my personal company for which I work as freelancer. Vdhicts develops
and implements IT solutions for businesses and educational institutions.
