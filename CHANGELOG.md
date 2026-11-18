# Changelog

All notable changes to this project will be documented in this file.

## 2.2.0 - 2026-11-18

### Changed

- Requires the 2.0 of its Laravel package, which runs on [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the engine shared by the privacy suites. Same pages, settings and tables: nothing to change in your panel.

## 2.1.0 - 2026-11-16

- Translations for 17 more languages: ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN (19 in total with en and pt_BR)

## 2.0.0 - 2026-11-16

Filament 4: data retention page for [laravel-lgpd-retention](https://github.com/jeffersongoncalves/laravel-lgpd-retention).

- Preview: how many records would be anonymized now, per model and column
- Apply retention: anonymize every column whose period has ended
- Re-apply after backup: erase again what a restored backup brought back
- Tombstones list (no personal data), filters by model and column
- English and Brazilian Portuguese

## [Unreleased]
