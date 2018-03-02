# Contributing to NASAPress Theme

## Theme development

### Build commands

* `yarn run start` — Compile assets when file changes are made, start Browsersync session
* `yarn run build` — Compile and optimize the files in your assets directory
* `yarn run build:production` — Compile assets for production

## Release process

### Git workflow

* We have one main branch that is never deleted:

    * `master` always points to the latest production release

* When introducing a change (feature, bug fix, etc.):

1. Branch off `master`:
1. Name your branch pretty much anything except `master`. Suggested prefixes include
   `refactor-`, `feature-`, and `patch-`.
1. Make changes, commit, and push your branch to github.
1. Test your changes.
1. When you are satisfied with your change, submit a [pull request](https://github.com/nasa/nasapress/pull/new/master).
1. A developer from our team will perform a code review and accept or reject your request.
1. You should delete your change branch. If you need to make a new change, create a new branch off of master.

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

## Theme Styles

To create custom styles for a specific page do the following to ensure your styles are scoped to only that page:

1. Create a new .scss file in `styles/pages` with the name of your page.
1. Wrap all statements in `body.slug-YOURSLUG { // statements go here }`. Where YOURSLUG is the last set of characters after the last / in the URL. "crcc" is the slug in this url: https://www1.grc.nasa.gov/facilities/crcc so we would use `body.slug-crcc`
1. Add an `@import` statement to `styles/main.scss` with your scss file without the extension ex. `@import "pages/sep";`
1. Save all files and run `yarn run build`

## Theme javascript

To create custom javascript for a particular page or page template do the following:

1. Create a new .js file in `scripts/routes` with the name of your page or page template.
1. Paste the following into the file and save it.

```js
export default {
  init() {
    // JavaScript to be fired on this page
  },
};
```

1. Add your javascript code after the comment.
1. Open `scripts/main.js` and add an import statement for your route. Ex. `import slug1x1 from './routes/1x1';`. Notice the variable name we assigned of `slug1x1`. This has to match a css classname attached to the `<body>` tag converted to camelCase or your javascript will not run. So if we want javascript that only runs on the 1x1 page, since the body will have a class of `slug-1x1` on this page, removing the dashes to convert to camelCase would make our variable name `slug1x1`. If the page name is `/my-page` our variable name would be `slugMyPage`. We can use other body classes as well, so if you want javascript to run only on the landing page template which adds a `template-landing` class to the body, use `templateLanding` as the variable name.
1. Add your import variable to the Router:

```js
const routes = new Router({
  // All pages
  common,
  // 1x1 page
  slug1x1,
});
```
1. Save all files and run `yarn run build`
