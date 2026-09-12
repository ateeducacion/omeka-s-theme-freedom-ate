---
name: freedom-theme
description: "Change theme templates, metadata display, helper validation, or Sass assets."
---

# Freedom ATE theme

Inspect `config/theme.ini`, `view/`, `helper/`, `asset/sass/`, `gulpfile.js`, and `package.json`.
The default branch is `master`; the release folder is `freedom-ate`.

- Follow the existing template and helper registration in the theme. Compare overrides with the supported
  Omeka core before copying a template, and preserve native view events and site-aware links.
- Use `SafeCssColor`, `SafeCssLength`, and `SafeUrl` for their existing boundaries. Escape metadata
  according to HTML/attribute/URL context; preserve intentional rendered media HTML.
- Edit Sass source under `asset/sass/`, then run `npm ci` and `npm run build`. Review generated CSS/maps
  with the source diff; do not fix compiled CSS directly.
- Keep empty metadata, unavailable media and multi-value resources usable. Check keyboard focus,
  contrast and narrow-screen layouts for view/style changes.

Run affected helper tests under `test/FreedomAteTest/` and the full suite. Check public browse/show
pages with real media after rendering changes. The package target uses rsync, not git archive:
verify both archive paths exclude agent tooling, and preserve the release's `freedom-ate/` directory.
