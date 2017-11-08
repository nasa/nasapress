<a class="usa-skipnav" href="#main-content">Skip to main content</a>
<header class="usa-header usa-header-basic usa-header-dark" role="banner">
  <div class="usa-nav-container">
    <div class="usa-navbar">
      <div class="usa-logo" id="logo">
        <em class="usa-logo-text">
          <a href="{{ esc_url(home_url('/')) }}" accesskey="1" title="Home" aria-label="Home">
            <img src="@asset('images/logo-nasa.svg')" alt="NASA logo">
            <!-- todo-config -->
            <span class="usa-logo-main-text">Glenn </span><br/>Research Center</a>
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
      @include('partials.search')
    </nav>
  </div>
</header>


