# NASAPress (a WordPress Theme)

![screen shot 2018-06-15 at 12 31 39 pm](https://user-images.githubusercontent.com/1322063/41479194-64b3bab2-7098-11e8-81cf-ccf93f472f61.png)

## Sites using NASAPress

If you'd like your site to be added to this list please [create an issue](https://github.com/nasa/nasapress/issues/new) with your website name and URL.

* [NASA Glenn Research Center](https://www1.grc.nasa.gov)
* [NASA LARC Engineering Design Studio](https://eds.larc.nasa.gov)
* [CLARREO Pathfinder](https://clarreo-pathfinder.larc.nasa.gov/)

## Features

* Built on [Sage 9.0.0-beta.3](https://github.com/roots/sage/releases/tag/9.0.0-beta.3)
* Sass for stylesheets
* ES6 for JavaScript
* [Webpack](https://webpack.github.io/) for compiling assets, optimizing images, and concatenating and minifying files
* [Browsersync](http://www.browsersync.io/) for synchronized browser testing
* [Laravel's Blade](https://laravel.com/docs/5.3/blade) as a templating engine
* [NASA Glenn Web Design System](https://nasa.github.io/nasawds-site/) based on the [U.S. Web Design System](https://designsystem.digital.gov) for CSS framework
* [Font Awesome](http://fontawesome.io/)


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


## Production Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 5.6.4
* MySQL >= 5.6 or MariaDB >= 10.0
  * Earlier versions don't support FULLTEXT index for InnoDB engine required by YARPP plugin. See [this explanation of issue](https://easyengine.io/tutorials/mysql/yarpp-innodb/).
* [Composer](https://getcomposer.org/download/)
  * Alternativly you can create a theme package on another machine and transfer it to your production enviroment, removing the need for composer to be installed in production. Please see the [Production Install - Composer on another machine](#production-install---composer-on-another-machine) section for more details.


## Development Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 5.6.4
* MySQL >= 5.6 or MariaDB >= 10.0
  * Earlier versions don't support FULLTEXT index for InnoDB engine required by YARPP plugin. See [this explanation of issue](https://easyengine.io/tutorials/mysql/yarpp-innodb/).
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)


# Theme Installation

There are multiple options for installing NASAPress. Please select the appropriate one for your enviroment.

## Production Install - With Composer

Clone this repo into your WordPress themes directory. *(Adjust to match your WordPress installation directory)*
```shell
$ cd /var/www/html/wordpress/wp-content/themes/
$ git clone https://github.com/Celestialdeath99/nasapress.git
```

Move into the newly created folder: `cd nasapress/`

Install Composer dependencies
```shell
$ composer install
```

## Production Install - Composer on another machine

If you do not want to install composer on your production machine there is a workaround. First, make sure you have composer installed on your staging machine. You will not need WordPress or MySQL on this machine.

Clone this repository to your staging machine that has composer installed.
```shell
$ git clone https://github.com/Celestialdeath99/nasapress.git
```

Move into the `nasapress` folder that was just created and install the composer dependencies.
```shell
$ composer install
```

Copy the entire nasapress folder from your staging enviroment into your `wp-content/themes/` folder.


## Development Install - Used for developing the theme

Clone this repository to your staging machine that has composer installed.
```shell
$ git clone https://github.com/Celestialdeath99/nasapress.git
```

Move into the `nasapress` folder that was just created and install the composer dependencies.
```shell
$ composer install
```

Install the yarn dependencies.
```shell
$ yarn install
```

Update `resources/assets/config.json` settings:
  * `devUrl` should reflect your local development hostname
  * `publicPath` should reflect your WordPress folder structure (`/wp-content/themes/nasapress` for non-[Bedrock](https://roots.io/bedrock/) installs)

After you have made your changes you can compile your changes using yarn.
```shell
$ yarn run build
```

## Theme setup

Search the theme folder for `todo-config`. These comments mark the locations where you'll likely need to make customizations for your site.

### Add top navigation

Create a menu and assign it to the 'Primary Navigation' location.

### Configure the site styling in the navigation menu

You can configure the site logo and site title in the navigation menu by using the **Header Settings** page under the **Appearance** section of the WordPress Administration page.

## Configuring Page Options

When you create a page, there are many different options avaiable to you that will allow you to customize the page to your liking.

### Configuring the Hero Header

![image](https://user-images.githubusercontent.com/6267549/60538334-6ef61200-9cd8-11e9-8c19-c10093ba8386.png)

The hero header consists of several parts on each page. Those sections include the image that is displayed, the page title, and the leading paragraph.

#### Disabling the Hero Header

If you do not wish to display a hero header on the page you are editing, you can disable it by changing the *Display Hero Header (Selecting NO will also cause the Header Image, Leading Paragraph and Page Title to not be displayed)?* option to *No*.

> Please keep in mind that if you disable the Hero Header you will get a navigation menu with a solid color background. You can configure that color in the Header Settings page under the Appearance section in the WordPress Administration Console.

#### Setting the Hero Header Image

You can set the image that is displayed in the hero header by clicking the *Select* button and either choosing an image from your sites media gallery or uploading a new one.

> Please keep in mind that the full image may not be displayed based upon the size of the viewers screen and that there is a filter over the image.

#### Setting the Hero Header Size

You can configure the size of the hero header for each page by entering a valid CSS size. This can be any value followed by either *px*, *rem*, or *em*.

#### Displaying and customizing the Page Title displayed in the header

You can configure if you would like to display the title of the page inside the hero header by selecting the appropriate value in the *Display the page title?* option. If you would like to display custom text in that field, please select *Yes* for both the previously mentioned option as well as the *Display custom page title?* option and then enter the text you wish to display as a title in the header in the field below.

#### Adding a leading paragraph

If you would like to display a leading paragraph you may enter that into the text field called *Leading Paragraph*. If you wish to disable the leading paragraph, simply remove all the text from that text field.

## Using the theme

### On this page navigation

The default and landing page templates automatically convert h2, h3, and h4 tags into left 'in page' navigation. For shorter pages, this may not be desired, and can be turned off in the "On this page" settings on the edit page screen. In this section, you can also change which heading tags to convert to navigation.


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
