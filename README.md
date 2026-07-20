# Freedom ATE — Omeka S theme

An Omeka S theme for **ATE Educación** (Área de Tecnología Educativa, Consejería de
Educación del Gobierno de Canarias), used to run a **digital resource repository service
for public schools**.

It is a fork of the [Freedom](https://github.com/omeka-s-themes/freedom) theme, adapted to
the needs of that service: institutional branding, editor tooling for teaching staff, a
richer browse and search experience, and Spanish localisation.

<a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">
  <img src="https://raw.githubusercontent.com/ateeducacion/omeka-s-theme-freedom-ate/refs/heads/master/.github/assets/playground-preview-button.svg" alt="Try Freedom ATE in your browser" width="224">
</a><br>
<small><a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">Try in your browser</a></small>

---

## Origin and attribution

This theme is **not** an original work. It descends from the Freedom theme for Omeka S,
and this repository's history begins with that theme's own commits.

| | |
|---|---|
| **Upstream theme** | [Freedom](https://github.com/omeka-s-themes/freedom), also developed at [nelsonamaya82/theme-freedom](https://github.com/nelsonamaya82/theme-freedom) |
| **Original author** | Nelson Amaya — [Out of the Bugs](https://www.outofthebugs.com) |
| **Also contributed by** | The Omeka team at [RRCHNM](https://rrchnm.org) (Roy Rosenzweig Center for History and New Media) |
| **Platform** | [Omeka S](https://omeka.org/s/), by RRCHNM |
| **This fork** | ATE Educación, Gobierno de Canarias |

Credit for the design and the great majority of the code belongs upstream. Please report
issues with this fork here, not to the upstream authors.

### Changes made in this fork

The GPL asks that modified versions carry prominent notice of their modification, so the
substantive divergences from upstream are listed here:

- **Institutional branding** — configurable institutional logo in the header top bar, and
  an optional link to the landing page of the installation.
- **Editor tooling** — inline edit / add media / delete actions for users with editing
  rights on the current site, with a confirmation modal (`CanEditInCurrentSite` helper).
- **Resource tags** — colour-coded tags derived from resource type and class, plus a
  publication-age badge based on `dcterms:date`.
- **Browse and search** — grid/list layouts with a toggle, body property truncation
  options, and templates for the [AdvancedSearch](https://gitlab.com/Daniel-KM/Omeka-S-module-AdvancedSearch)
  module.
- **Spanish localisation** — full `es` translation (`language/es.po`).
- **Security hardening** — output escaping and validation of theme settings used in
  `<style>` blocks and `href` attributes.

See the commit history for the complete record.

---

## Licensing

This theme is distributed under the **GNU General Public License v3.0**. The full text is
in [`LICENSE`](LICENSE).

Both the `LICENSE` file and the source headers come from upstream, and they are worth
reading together: the Sass header in `asset/sass/style.scss` states *"GNU General Public
License v2 or later"*, while the bundled licence text is v3. The "or later" clause is what
makes this coherent — it permits distribution under v3, which is what the `LICENSE` file
does and what `package.json` declares.

### What this means if you reuse this theme

The GPL is copyleft, so redistributing it — modified or not — carries obligations:

1. **Keep the licence and copyright notices.** Do not strip `LICENSE` or the headers in
   the Sass sources.
2. **Distribute under the same licence.** Derivative works must also be GPL-3.0.
3. **State your changes**, as this README does above.
4. **Provide the source.** If you distribute the theme, recipients must be able to get the
   corresponding source, including your modifications.

Attribution to the original authors is not merely courteous here — preserving the notices
is a licence condition.

### Third-party assets

- **Fonts** — Open Sans and Noto Serif are loaded from Google Fonts at runtime, and
  Material Symbols via a Sass `@import`. They are not bundled in this repository. Note
  that this makes a request to Google on every page load, which may matter for your
  privacy assessment; self-hosting them is the mitigation.
- **Icons** — the Omeka S icon font is provided by the platform, not by this theme.
- **Institutional logos** are uploaded by administrators through the theme settings and
  are not part of this repository. They are typically subject to their own usage rules,
  which are independent of this theme's licence.

---

## Installation

For normal use, follow the [Omeka S User Manual instructions for installing
themes](https://omeka.org/s/docs/user-manual/sites/site_theme/#installing-themes).

Requires Omeka S `^4.1.0`.

To work on the theme's Sass you will need [Node.js](https://nodejs.org/en/). From the
theme directory:

```bash
npm install
```

---

## Theme settings

Configured per site under *Sites → [site] → Theme*.

### General
- **Primary / Secondary / Accent colour** — used to derive the CSS custom properties the
  stylesheet is built on. Only hexadecimal values are accepted.

### Header
- **Header Menu** — show the navigation menu; if off, only the logo and site name appear.
- **Header Layout** — inline, or centred logo and menu.
- **Top Navigation Depth** — maximum menu levels; 0 or empty shows all.
- **Logo** — the site logo, next to the site name.
- **Institutional Logo** — shown at the top left of the header.
- **Landing Page Link** — optional logo linking to the service landing page. Requires both
  a logo and a URL; if either is missing the link is not rendered.

### Banner
Image, heading, description, content position, width, height, height on mobile, and the
image's vertical and horizontal position within its wrapper.

### Footer
Logo, site description, menu and menu depth, free content, and copyright notice.

### Social Media
Facebook, Twitter, LinkedIn, Instagram, YouTube and Mastodon URLs. Only `http(s)` URLs are
accepted; anything else is not rendered.

### Image Settings
Decorative border for media and/or assets.

### Resource Tags
Show tags derived from resource type and/or resource class.

### Browse Settings
Layout for browse pages (grid, list, or either with a visitor toggle) and body property
truncation.

---

## Development

Run from the theme's root directory:

| Command | Purpose |
|---|---|
| `npm run start` | Watch Sass files and recompile on change |
| `npx gulp css` | One-off compile of Sass to CSS |
| `npm run compile-translations` | Compile `.po` files to `.mo` |

> [!IMPORTANT]
> **`asset/css/style.css` is generated but committed.** After changing any `.scss` file you
> must run the build and commit the result, otherwise the repository ships a stylesheet
> that does not match its own sources. This has drifted before.

### Translations

Strings live in `language/`. `template.pot` is the extraction template, `es.po` the Spanish
catalogue, and `es.mo` the compiled form that Omeka actually loads — regenerate it after
editing `es.po`.

### View overrides

Templates in `view/` override those of Omeka S and of modules; Omeka resolves view scripts
by path and the theme wins over the module, so nothing needs registering in `config/`.
`view/search/` holds overrides for the AdvancedSearch module — copy the module's original
partial as a starting point and edit it here rather than modifying the module.

Where several search pages need different layouts, give each its own partial name and
point each search page at its own; overwriting the canonical partial breaks the others.

If a change does not appear, clear Omeka's `files/cache/` and the PHP OPcache before
looking for other causes.

### Sass structure

```bash
sass
    ├── abstracts        # variables (breakpoints, colors, layout, typography) and mixins
    ├── base             # elements, layout and typography
    ├── components       # header, footer, banner, navigation, blocks, resources, facets…
    ├── generic          # box-sizing, normalize
    └── utilities        # accessibility, alignments, clearfix
```

### Utility classes

Predefined classes that can be combined on any element:

`inline` · `alignleft` · `alignright` · `aligncenter` · `alignfull` · `alignwide` ·
`alignnarrow` · `textleft` · `textright` · `textcenter` · `clearfix` · `screen-reader-text`
