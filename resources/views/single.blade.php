@extends('layouts.app')

@section('content')

<main class="usa-grid usa-section usa-content usa-layout-docs no-hero" id="main-content">
    <div class="usa-width-three-fourths usa-layout-docs-main_content">
  @while (have_posts()) @php(the_post())
    @include('partials/content-single-'.get_post_type())
  @endwhile
    </div>
    <aside class="usa-width-one-fourth usa-serif-body">
  @php
			dynamic_sidebar('posts-nav-bar');
		@endphp
  </aside>

</main>
@endsection
