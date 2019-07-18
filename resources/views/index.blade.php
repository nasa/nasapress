@extends('layouts.app')

@section('content')

<main class="usa-grid usa-section usa-content usa-layout-docs no-hero" id="main-content" style="min-height: 75vh">
  
  @if (!have_posts())

  <div class="usa-width-one-whole alert alert-warning">
    <p class="usa-font-lead">
    {{ __('Sorry, this topic as no posts.', 'sage') }}
    </p>
  </div>

  @else

  <div class="usa-width-three-fourths usa-layout-docs-main_content">
  <h2>@php wp_title(false) @endphp</h2>
  @while (have_posts()) @php(the_post())
    @include ('partials.content')
  @endwhile

  {!! get_the_posts_navigation() !!}
  </div>
  <aside class="usa-width-one-fourth usa-serif-body">
  @php
			dynamic_sidebar('posts-nav-bar');
		@endphp
  </aside>

  @endif

</main>
@endsection
