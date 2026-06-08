# This is an adaptation of Freedom S Theme for using in ATE

<a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">
  <img src="https://raw.githubusercontent.com/ateeducacion/omeka-s-theme-freedom-ate/refs/heads/master/.github/assets/playground-preview-button.svg" alt="Try Freedom ATE in your browser" width="224">
</a><br>
<small><a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">Try in your browser</a></small>

This is an Omeka S theme that offers some custom options and a clean design.
![Freedom Theme](https://github.com/omeka-s-themes/freedom/blob/master/theme.jpg?raw=true)

## Installation

For basic out-of-the-box use of the theme, follow the [Omeka S User Manual instructions for installing themes](https://omeka.org/s/docs/user-manual/sites/site_theme/#installing-themes).

For more advanced use, such as customizing the theme with Sass, you'll need to install the tools with [NodeJS](https://nodejs.org/en/) (0.12 or greater). Navigate to your theme directory and run `npm install`.

## Theme settings

### Theme's Primary Color
The color to be used as the theme's primary color. The default value is #e77f11 (RGB 231, 127, 17).

### Header Layout
- Inline logo and menu
- Centered logo and menu

### Top Navigation Depth
Maximum number of levels to show in the site's top navigation bar. Set to 0 to show all levels.

### Logo
A custom logo (SVG, JPG, PNG)

### Banner
- Banner image
- Heading
- Description
- Content position
- Banner width
- Banner height
- Banner height for mobile devices
- Banner image vertical position within the wrapper
- Banner image horizontal position within the wrapper

### Footer
- Footer Logo
- Footer Site description
- Footer Menu
- Footer Menu Depth
- Footer Content
- Footer Copyright

### Social Media
- Facebook
- Twitter
- LinkedIn
- Instagram
- Youtube
- Mastodon

### Image Settings
- Decorative border for Media and/or Assets

### Resource Tags
- Show tags based on Resource Type or Class

### Browse Settings
- Layout for Browse Pages
- Truncate Body Property

## Customizing the Theme

If you want to customize the site with your own CSS, the [CSS Editor](https://omeka.org/s/modules/CSSEditor/) module allows site administrators to write style overrides.

For advanced CSS and Sass users, this theme includes variables and mixins for managing and extending many styles.

### Sass Tasks

Run these commands within the theme's root directory.

* **npm run start**: While this task runs, it watches for changes to sass files and recompiles the CSS.
* **gulp css**: This is the one-off task for compiling the current Sass/CSS.
* **gulp css:watch**: This task watches for changes in the Sass, then compiles the CSS.

### Sass File Structure

```bash
sass
    ├── abstracts
    │   ├── mixins
    │   └── variables
    │       ├── breakpoints
    │       ├── colors
    │       ├── layout
    │       └── typography
    ├── base
    │   ├── elements
    │   │   ├── body
    │   │   ├── buttons
    │   │   ├── caption
    │   │   ├── fields
    │   │   ├── hr
    │   │   ├── icons
    │   │   ├── language-tag
    │   │   ├── links
    │   │   ├── lists
    │   │   ├── media
    │   │   ├── resource-description
    │   │   ├── resource-tag
    │   │   ├── tables
    │   │   ├── titles
    │   │   └── tooltip
    │   ├── layout
    │   │   ├── layout
    │   │   └── regions
    │   └── typography
    │       ├── copy
    │       ├── headings
    │       └── typography
    ├── components
    │   ├── accordion
    │   ├── advanced-search
    │   ├── annotation
    │   ├── banner
    │   ├── blocks
    │   │   ├── assets
    │   │   ├── browse-preview
    │   │   ├── carousel
    │   │   ├── collecting
    │   │   ├── item-showcase
    │   │   ├── item-with-metadata
    │   │   ├── list-of-sites
    │   │   ├── media-embed
    │   │   ├── table-of-contents
    │   │   └── timeline
    │   ├── breadcrumbs
    │   ├── facets
    │   ├── footer
    │   ├── header
    │   ├── linked-resources
    │   ├── metadata
    │   ├── navigation
    │   ├── pagination
    │   ├── resources
    │   │   ├── browse-controls
    │   │   ├── resource-grid
    │   │   ├── resource-list
    │   ├── search-results
    │   ├── uri-dereferencer
    │   └── user-bar
    ├── generic
    │   ├── box-sizing
    │   └── normalize
    └── utilities
        ├── accessibility
        ├── alignments
        └── clearfix
```

## Utility classes
Freedom S offers a set of predefined utiliy classes that will help you to add styles to certain elements by just assigning them these classes.

You can even combine multiple utility classes.

- `inline`
- `alignleft`
- `alignright`
- `aligncenter`
- `alignfull`
- `alignwide`
- `alignnarrow`
- `textleft`
- `textright`
- `textcenter`
- `clearfix`
- `screen-reader-text`


