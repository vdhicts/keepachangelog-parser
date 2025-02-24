# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to 
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.3.0] - 2025-02-24

### Added

- Add support for Laravel 11.

### Changed

- Move Pint to dev dependencies. Thanks to @julesjanssen.

### Removed

- Remove Laravel 9 and 10 support as they no longer receives any updates.

## [2.2.0] - 2024-03-17

### Added

- Add support for Laravel 11. Thanks to @julesjanssen.
- Make the Dateformat configurable. Thanks to @fabianpnke.

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
