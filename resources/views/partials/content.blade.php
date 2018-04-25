<article @php(post_class())>
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
    @if (get_post_type() == 'post')
      @include('partials/entry-meta')
    @endif
  </header>
  @if (get_post_type() == 'page')
  <div class="entry-summary usa-grid-full"><div class="usa-width-one-third"><figure class="wp-caption">{!! get_the_post_thumbnail(null, 'thumbnail') !!}<figcaption class="wp-caption-text">{!! get_the_post_thumbnail_caption() !!}</figcaption></figure></div><div class="usa-width-two-thirds">@php(the_excerpt())</div></div>
  @else   
  <div class="entry-summary">
    @php(the_excerpt())
  </div>
  @endif
</article>
