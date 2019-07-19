<a class="usa-skipnav" href="#main-content">Skip to main content</a>
@if ( trim(get_post_meta(get_the_ID(), 'options_display_hero', true)) == 'Yes' )
<header class="usa-header usa-header-basic usa-header-dark">
@else
<header class="usa-header usa-header-basic usa-header-dark" style="background-color: {{ get_option( 'header_settings_background_color' ) }}; padding-bottom: 1rem;">
@endif
  <div class="usa-nav-container">
    <div class="usa-navbar">
      <div class="usa-logo" id="logo">
        <em class="usa-logo-text">
          <a href="{{ esc_url(home_url('/')) }}" accesskey="1" title="Home" aria-label="Home">
			@php
			  echo '<img src="' . esc_url( wp_get_attachment_image_url( get_option( 'header_settings_logo' ) , 'full' ) ) . '" alt="Site Logo">';
			  echo '<span class="usa-logo-main-text">' . get_option( 'header_settings_title_one' ) . '&nbsp;</span><br>' . get_option( 'header_settings_title_two' ) . '</a>';
			@endphp
        </em>
      </div>
      <button class="usa-menu-btn">Menu</button>
    </div>
    <nav class="usa-nav usa-nav-dark">
      <button class="usa-nav-close">
        <img src="{{ get_template_directory_uri() }}/assets/images/close.svg" alt="close">
      </button>
      @php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array(
            'theme_location' => 'primary_navigation',
            'container' => false,
            'menu_class' => 'usa-nav-primary usa-accordion',
            'link_before' => '<span>',
            'link_after' => '</span>',
            //'fallback_cb' => 'default_header_nav',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'walker' => new App\NASAWDSBasicNavwalker()
          ));
        endif;
      @endphp
    </nav>
  </div>
</header>