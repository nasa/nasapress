@extends('layouts.app')

@section('content')
@if ( trim(get_post_meta(get_the_ID(), 'options_display_hero', true)) == 'Yes' )
<main id="main-content" class="usa-content usa-layout-docs">
@else
<main id="main-content" class="usa-content usa-layout-docs no-hero">
@endif
  @while(have_posts()) @php(the_post())
  @if ( trim(get_post_meta(get_the_ID(), 'options_display_hero', true)) == 'Yes' )
  <section class="usa-hero"
    style="background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), #212121 url({{ esc_url( wp_get_attachment_image_url( get_post_meta(get_the_ID(), 'options_header_image_url', true) , 'full' ) ) }}) 50% / cover;
		background: -o-linear-gradient(top, rgba(0, 0, 0, 0.7) 0, rgba(0, 0, 0, 0.7) 100%), #212121 url({{ esc_url( wp_get_attachment_image_url( get_post_meta(get_the_ID(), 'options_header_image_url', true) , 'full' ) ) }}) 50% / cover;
		background: linear-gradient(180deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), #212121 url({{ esc_url( wp_get_attachment_image_url( get_post_meta(get_the_ID(), 'options_header_image_url', true) , 'full' ) ) }}) 50% / cover;
		height: {{ get_post_meta(get_the_ID(), 'options_header_size', true) }}">
    <div class="usa-grid">
      <div class="usa-width-one-half">
        @php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">','</div>');
			}
        @endphp
        @if ( trim(get_post_meta(get_the_ID(), 'options_display_title', true)) == 'Yes' )
        @include('partials.page-header')
        @endif
      </div>
    </div>
    <div class="usa-grid">
      <div class="usa-width-three-fourths">
        <p class="usa-font-lead">{{ get_post_meta(get_the_ID(), 'options_leading_paragraph', true) }}</p>
      </div>
    </div>
    <!-- custom html here -->
  </section>
  @endif

  @if ( trim(get_post_meta(get_the_ID(), 'options_full_width', true)) == 'Default' )
  <div class="usa-grid usa-section" style="padding-top: {{ get_post_meta(get_the_ID(), 'options_top_padding', true) }}">
  @elseif ( trim(get_post_meta(get_the_ID(), 'options_full_width', true)) == '100%' )
  <div class="usa-grid usa-section" style="max-width: 100%; padding-left: 0; padding-right: 0; padding-top: {{ get_post_meta(get_the_ID(), 'options_top_padding', true) }}">
  @else
  <div class="usa-grid usa-section" style="max-width: {{ get_post_meta(get_the_ID(), 'options_full_width', true) }}; padding-top: {{ get_post_meta(get_the_ID(), 'options_top_padding', true) }}">
  @endif
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