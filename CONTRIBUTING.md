# Contributing to NASAPress Theme

## Theme development

### Build commands

* `yarn run start` — Compile assets when file changes are made, start Browsersync session
* `yarn run build` — Compile and optimize the files in your assets directory
* `yarn run build:production` — Compile assets for production

## Release process

### Git workflow

* We have three main branches that are never deleted:

    * `master` always points to the latest production release
    * `develop` contains changes being prepped for a release
    * `staging` contains changes being tested on [our staging server](https://ewwwd1.grc.nasa.gov/wordpress)

* When introducing a change (feature, bug fix, etc.):

1. Branch off `develop`:
1. Name your branch pretty much anything except `master`, `develop`, `staging`, or
   with the `release-` or `hotfix-` prefix. Suggested prefixes include
   `refactor-`, `feature-`, and `patch-`.
1. Make changes, commit, and push your branch to gitlab.
1. Test your changes locally.
1. When you are satisfied with your change, file your [merge request](https://gitlab.grc.nasa.gov/wade/nasapress-grc/merge_requests/new) to merge into the `develop` branch on GitLab by selecting your branch as the source branch and `develop` branch as the target branch.
1. Another developer will perform a code review and accept or reject your request. After accepting, they may do some brief testing on their local development environment.
1. They will then merge the develop branch with the staging branch, and deploy the staging branch to the staging server.
1. They will notify you that your changes are now on the staging server.
1. You should then perform QA on the staging server.
1. If there are no issues in staging, they will merge staging with master, and deploy master to the production server.
1. They will notify you when your change is live. 
1. You should delete your change branch. If you need to make a new change, create a new branch off of develop.

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