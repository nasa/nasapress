<!doctype html>
<!--[if lt IE 9]><html class="lt-ie9" @php(language_attributes())><![endif]-->
<!--[if gt IE 8]><!--><html @php(language_attributes())><!--<![endif]-->
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')

      @yield('content')

    @if (App\display_sidebar())
      <aside class="sidebar">
        @include('partials.sidebar')
      </aside>
    @endif
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
