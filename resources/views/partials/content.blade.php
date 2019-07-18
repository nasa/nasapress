<article @php(post_class())>
  <header>
    <h3 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h3>
    @if (get_post_type() == 'post')
      @include('partials/entry-meta')
    @endif
  </header>
  <div class="entry-summary usa-grid-full">
    @php( $post_thumbnail = get_the_post_thumbnail(null, 'thumbnail') )
    @if ($post_thumbnail)
      <div class="usa-width-one-third"><figure class="wp-caption">{!! $post_thumbnail !!}<figcaption class="wp-caption-text">{!! get_the_post_thumbnail_caption() !!}</figcaption></figure></div><div class="usa-width-two-thirds">@php( the_excerpt() )</div>
    @else   
      @php( the_excerpt() )
    @endif
  </div>
</article>
