<header>
  @if ( trim(get_post_meta(get_the_ID(), 'options_custom_title_select', true)) == 'No' )
  <h1>{!! App\title() !!}</h1>
  @else
  <h1>{{ get_post_meta(get_the_ID(), 'options_custom_title', true) }}</h1>
  @endif
</header>