# NASAPress (a WordPress Theme)

![screen shot 2018-06-15 at 12 31 39 pm](https://user-images.githubusercontent.com/1322063/41479194-64b3bab2-7098-11e8-81cf-ccf93f472f61.png)

## Sites using NASAPress

If you'd like your site to be added to this list please [create an issue](https://github.com/nasa/nasapress/issues/new) with your website name and URL.

* [NASA Glenn Research Center](https://www1.grc.nasa.gov)

## Features

* Built on [Sage 9.0.0-beta.3](https://github.com/roots/sage/releases/tag/9.0.0-beta.3)
* Sass for stylesheets
* ES6 for JavaScript
* [Webpack](https://webpack.github.io/) for compiling assets, optimizing images, and concatenating and minifying files
* [Browsersync](http://www.browsersync.io/) for synchronized browser testing
* [Laravel's Blade](https://laravel.com/docs/5.3/blade) as a templating engine
* [NASA Glenn Web Design System](https://nasa.github.io/nasawds-site/) based on the [U.S. Web Design System](https://designsystem.digital.gov) for CSS framework
* [Font Awesome](http://fontawesome.io/)

### Required plugins

* [Add Categories to Pages](https://wordpress.org/plugins/add-category-to-pages/)
* [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/)

### Recommended plugins

* [NASAPress Companion](https://github.com/nasa/nasapress-companion)
  * adds shortcodes for displaying nasa.gov news articles, spinoffs, and lists of pages.
* [Advanced TinyMCE Configuration](https://wordpress.org/plugins/advanced-tinymce-configuration/)
    * allows editors to add NASA Web Design Standards styles to elements in the visual text editor.
* [TinyMCE Advanced](https://wordpress.org/plugins/tinymce-advanced/)
* [Better WordPress External Links](https://wordpress.org/plugins/bwp-external-links/)
    * Plugin Settings:
      * Set External links' CSS class to `usa-external_link`
      * Uncheck 'Use CSS provided by this plugin?'
* [Disable Search](https://wordpress.org/plugins/disable-search/)
  * if using DigitalGov Search
* [Responsive Lightbox](https://wordpress.org/plugins/responsive-lightbox/)
    * for viewing images in a lightbox.
* [Yet Another Related Posts Plugin](https://wordpress.org/plugins/yet-another-related-posts-plugin/)
* [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/)
  * for breadcrumbs
* [Gravity Forms](http://www.gravityforms.com/) and [Gravity Forms Survey Add-On](http://www.gravityforms.com/add-ons/survey/)
  * for site feedback form and other forms.
* [Popup Maker](https://wordpress.org/plugins/popup-maker/)
  * for displaying site feedback form in a popup window.
* [Hide YouTube Related Videos](https://wordpress.org/plugins/hide-youtube-related-videos/)
* [Broken Link Checker](https://wordpress.org/plugins/broken-link-checker/)

### Designed for use with these services

* [Digital Analytics Program](https://www.digitalgov.gov/services/dap/)
* [DigitalGov Search](https://search.digitalgov.gov/)

## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 5.6.4
* MySQL >= 5.6 or MariaDB >= 10.0
  * Earlier versions don't support FULLTEXT index for InnoDB engine required by YARPP plugin. See [this explanation of issue](https://easyengine.io/tutorials/mysql/yarpp-innodb/).
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

## Theme installation

Clone this repo into your WordPress themes directory.

Install Composer dependencies:

```shell
# @ app/themes/nasapress or wp-content/themes/nasapress
$ composer install
```

Run `yarn` from the theme directory to install dependencies. If you won't be making changes to the theme's static assets (css, javascript, images) then run `yarn install --production`.

Update `resources/assets/config.json` settings:
  * `devUrl` should reflect your local development hostname
  * `publicPath` should reflect your WordPress folder structure (`/wp-content/themes/nasapress` for non-[Bedrock](https://roots.io/bedrock/) installs)

## Theme setup

Search the theme folder for `todo-config`. These comments mark the locations where you'll likely need to make customizations for your site.

### Add top navigation

Create a menu and assign it to the 'Primary Navigation' location.

### Enable breadcrumbs

Install and activate the Yoast SEO plugin. Follow steps 1-5 [in this guide](https://kb.yoast.com/kb/implement-wordpress-seo-breadcrumbs/) to enable yoast breadcrumbs.

### Enable related pages

If you want to show related pages at the bottom of pages install and activate the YARPP plugin. On the plugin settings, you might see a message about 'consider titles' and 'consider bodies' being disabled due to InnoDB... If you are using MySQL 5.6 or greater, expand the message and click the 'Create FULLTEXT indices' button to enable them.

Under display options, select 'Pages', then click the Custom button and make sure 'You Might Also Like' is selected as the template file.

### Add NASA Web Design Standards styles to Visual Editor

todo

### Add site feedback form

todo

## Using the theme

### Page templates

#### Home page

Although not technically a template the theme expects a static front page and styles it differently than the others. Use the following as a starting point for this page.
```html
<div class="usa-overlay"></div>

<section class="usa-hero">
  <div class="usa-grid">
    <div class="usa-width-one-half">
      <h1>Shaping the world of tomorrow</h1>
    </div>
  </div>
  <div class="usa-grid">
    <div class="usa-width-one-half">
      <p class="usa-font-lead">By developing technologies that will enable further exploration of the universe and revolutionize air travel</p>
    </div>
  </div>
  <div class="usa-grid">
    <div class="usa-width-two-thirds">
      <div class="video-container">
        https://www.youtube.com/watch?v=5VHPanW6F4E
      </div>
    </div>
  </div>
</section>
```

#### Landing Page

The landing page template features a large hero image with leading paragraph followed by text. Make sure your featured image is large enough to not pixellate too much at larger screen sizes.

#### Default template

The default template has no top hero section.

### On this page navigation

The default and landing page templates automatically convert h2, h3, and h4 tags into left 'in page' navigation. For shorter pages, this may not be desired, and can be turned off in the "On this page" settings on the edit page screen. In this section, you can also change which heading tags to convert to navigation.

### Setting NASA Official

A NASA Official can be added or changed on the edit page category screen. You can select from any users of your WordPress site.

## Theme structure

```shell
themes/your-theme-name/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── lib/App/          # → NASAPress functions
│   ├── lib/Sage/         # → Blade implementation, asset manifest
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── composer.lock         # → Composer lock file (never edit)
├── dist/                 # → Built theme assets (never edit)
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── assets/           # → Front-end assets
│   │   ├── config.json   # → Settings for compiled assets
│   │   ├── build/        # → Webpack and ESLint config
│   │   ├── fonts/        # → Theme fonts
│   │   ├── images/       # → Theme images
│   │   ├── scripts/      # → Theme JS
│   │   └── styles/       # → Theme stylesheets
│   ├── functions.php     # → Composer autoloader, theme includes
│   ├── index.php         # → Never manually edit
│   ├── screenshot.png    # → Theme screenshot for WP admin
│   ├── style.css         # → Theme meta information
│   └── views/            # → Theme templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
└── vendor/               # → Composer packages (never edit)
```

## Theme development

### Build commands

* `yarn run start` — Compile assets when file changes are made, start Browsersync session
* `yarn run build` — Compile and optimize the files in your assets directory
* `yarn run build:production` — Compile assets for production

## Todos

Make site title customizable in wp-admin.
Make right side of footer customizable in wp-admin.
