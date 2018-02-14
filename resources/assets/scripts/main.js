/** import external dependencies */
import 'jquery';
import 'nasawds/dist/js/nasawds';
import './vendor/anchorific';
import 'stickyfill/dist/stickyfill.min';

/** import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import templateLanding from './routes/animation';
import './vendor/viewportchecker';
import './util/fadeinup';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
	// 1x1 page
  templateLanding,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
