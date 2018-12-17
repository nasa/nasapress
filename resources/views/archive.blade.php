@extends('layouts.app')

@section('content')

<main class="usa-grid usa-section usa-content usa-layout-docs" id="main-content">
  
  @if (!have_posts())

  <div class="usa-width-one-whole alert alert-warning">
    <p class="usa-font-lead">
    {{ __('Sorry, this topic as no posts.', 'sage') }}
    </p>
    <h3>Search this site:</h3>
    @include('partials.search', ['thisSite' => true])
  </div>

  @else

  <aside class="usa-width-one-fourth usa-layout-docs-sidenav sticky usa-serif-body"><p class='usa-layout-docs-sidenav-title'>On this page:</p><nav class='anchorific'></nav></aside>
  <div class="usa-width-three-fourths usa-layout-docs-main_content">
  @if (have_posts())
    @php
      $cat = get_category( get_query_var( 'cat' ) );
      $cat_id = $cat->cat_ID;
      echo category_description( $cat_id ); 
    @endphp
  @endif
  @while (have_posts()) @php(the_post())
    @include ('partials.content')
  @endwhile

  {!! get_the_posts_navigation() !!}
  </div>

  @endif

</main>
@endsection
