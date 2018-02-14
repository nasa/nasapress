import 'jquery';

// FadeInUp script to animate list items on GRC Home page

jQuery(document).ready(function() {
    jQuery('.grc-list').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInUp',
        offset: 120
       });
});