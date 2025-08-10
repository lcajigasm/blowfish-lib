# Changelog

All notable changes to this project will be documented in this file.

The format is based on Keep a Changelog, and this project adheres to Semantic Versioning.

## [0.2.0] - 2025-08-10
### Added
- Modernized class with typed properties and methods.
- Backwards compatibility shims for old method names.
- README expanded with installation, usage, security notes, and contributing.
- Composer script `example`.
- Changelog and example script.

### Changed
- Minimum PHP version raised to 7.4.
- Replaced manual salt + `crypt()` usage with `password_hash()` / `password_verify()`.

## [0.1.5] - 2019-??-??
### Added
- Initial release with basic Blowfish wrapper.

