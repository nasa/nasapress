import fadeInUp from '../util/fadeinup';

export default {
  init() {
    // JavaScript to be fired on the home page
    //
    // call FadeInUp script to animate list items on GRC Home page
    fadeInUp();
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
