// FadeInUp script to animate list items on GRC Home page

export default function fadeInUp() {
  $(document).ready(function() {
    $('.grc-list').addClass("hidden").viewportChecker({
      classToAdd: 'visible animated fadeInUp',
      offset: 120,
    });
  });
}