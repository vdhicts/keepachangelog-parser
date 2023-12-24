# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to 
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Make the Dateformat configurable.

## [2.1.0] - 2023-05-30

### Added

- Add support for HTML in the entries. Thanks to @julesjanssen.

## [2.0.0] - 2023-03-23

### Changed

- Updated to Laravel 10

## [1.2.0] - 2023-01-25

### Added

- A release can now include the tag reference (when provided) that can be found at the bottom of the changelog.

### Changed

- Applied property promotion to the models.

### Fixed

- Parsing a changelog with tag references resulted in an error. See [#3](https://github.com/vdhicts/keepachangelog-parser/issues/3), thanks to @bergo for reporting.

## [1.1.0] - 2022-02-15

### Changed

- Sort releases by the newest first as changelogs are known to set the latest release on top.

## [1.0.0] - 2022-02-15

### Added

- Initial version of this parser.
