<p class="post-meta">
<time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
<span class="byline author vcard">
  {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
</span>

@php $categories = get_the_category(); @endphp
@if ( ! empty( $categories ) ) 
  @php
    //Doesn't currently handle posts in multiple categories. If needed can add using: https://joshuawinn.com/using-yoasts-primary-category-in-wordpress-theme/
    $category_parents = get_category_parents($categories[0]->term_id, true, ',');
    if(!is_wp_error($category_parents)) {
      $category_parent = explode(',', $category_parents, -1);
      $category_crumbs = '';
      if($category_parent && is_array($category_parent)) {
        $i = 0;
        while($i < 2 && $category_parent) {
          $cur_category = array_pop($category_parent);
          if($i > 0) {
            $cur_category .= ' > ';
          }
          $category_crumbs = $cur_category . $category_crumbs;
          $i++;
        }
      }
    }
  @endphp
  <span>Posted in: {!! $category_crumbs !!}</span>
@endif
</p>