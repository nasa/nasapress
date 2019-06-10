<a class="usa-skipnav" href="#main-content">Skip to main content</a>
<header class="usa-header usa-header-basic usa-header-dark" role="banner">
  <div class="usa-nav-container">
    <div class="usa-navbar">
      <div class="usa-logo" id="logo">
        <em class="usa-logo-text">
          <a href="{{ esc_url(home_url('/')) }}" accesskey="1" title="Home" aria-label="Home">
			@php
			  $custom_logo_id = get_theme_mod( 'custom_logo' );
			  $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
			  echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="Site Logo">';
			@endphp
            <!-- todo-config -->
			  @php
			    $site_title = get_bloginfo( 'name');
			    $first_word = strstr( $site_title, ' ', true );
			    $remaining_title = strstr($site_title, ' ');
			    echo '<span class="usa-logo-main-text">' . $first_word . '</span><br>' . $remaining_title . '</a>';
			  @endphp
        </em>
      </div>
      <button class="usa-menu-btn">Menu</button>
    </div>
    <nav role="navigation" class="usa-nav usa-nav-dark">
      <button class="usa-nav-close">
        <img src="@asset('images/close.svg')" alt="close">
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


