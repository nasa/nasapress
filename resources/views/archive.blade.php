@extends('layouts.app')

@section('content')

<main class="usa-grid usa-section usa-content usa-layout-docs" id="main-content">


  
  @if (!have_posts())
    <div class="usa-width-one-whole alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  <aside class="usa-width-one-fourth usa-layout-docs-sidenav sticky usa-serif-body"><p class='usa-layout-docs-sidenav-title'>On this page:</p><nav class='anchorific'></nav></aside>
    <div class="usa-width-three-fourths usa-layout-docs-main_content">
  @if (have_posts())
    @include('partials.page-header')
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
</main>
@endsection
