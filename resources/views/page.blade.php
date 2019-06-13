@extends('layouts.app')

@section('content')
<main id="main-content" class="usa-content usa-layout-docs">
  <div class="usa-overlay"></div>
  @while(have_posts()) @php(the_post())
  <section class="usa-hero"
    style="background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), #212121 url({{ get_post_meta(get_the_ID(), 'options_header_image_url', true) }}) 50% / cover;
		background: -o-linear-gradient(top, rgba(0, 0, 0, 0.7) 0, rgba(0, 0, 0, 0.7) 100%), #212121 url({{ get_post_meta(get_the_ID(), 'options_header_image_url', true) }}) 50% / cover;
		background: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), #212121 url({{ get_post_meta(get_the_ID(), 'options_header_image_url', true) }}) 50% / cover;
		height: {{ get_post_meta(get_the_ID(), 'options_header_size', true) }}px">
    <div class="usa-grid">
      <div class="usa-width-one-half">
        @php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">','</div>');
			}
        @endphp
        @include('partials.page-header')
      </div>
    </div>
    <div class="usa-grid">
      <div class="usa-width-one-half">
        <p class="usa-font-lead">{{ get_post_meta(get_the_ID(), 'options_leading_paragraph', true) }}</p>
      </div>
    </div>
    <!-- custom html here -->
  </section>

  <div class="usa-grid usa-section">
    @php ($gridSize = 'one-whole')
    @if ( trim(get_post_meta(get_the_ID(), 'options_display_menu', true)) == 'Yes' )
    @php ($gridSize = 'three-fourths')
    <aside class="usa-width-one-fourth usa-layout-docs-sidenav sticky usa-serif-body">
      @if ( trim(get_post_meta(get_the_ID(), 'options_menu_type', true)) == 'Multi-page Menu' )
      {!! App\wpb_list_child_pages() !!}
      @else
      <p class='usa-layout-docs-sidenav-title'>On this page:</p>
      <nav class='anchorific' data-headings='{{ get_post_meta(get_the_ID(), 'options_tag_types', true) }}'></nav>
      @endif
    </aside>
    @endif
    <div class="usa-width-{{ $gridSize }} usa-layout-docs-main_content usa-serif-body">

      @include('partials.content-page')

    </div>
  </div>
  @endwhile
</main>
@endsection