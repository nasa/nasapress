@extends('layouts.app')

@section('content')
  <main class="usa-grid usa-section usa-content usa-layout-docs" id="main-content">
    @php ($gridSize = 'one-whole')
    @if ( !get_field('otp_hide') )
    @php ($gridSize = 'three-fourths')
    <aside class="usa-width-one-fourth usa-layout-docs-sidenav sticky usa-serif-body">
      @if ( trim(get_field('navigation_type')) == 'multiple_page' )
      {!! App\wpb_list_child_pages() !!}
      @else
      <p class='usa-layout-docs-sidenav-title'>On this page:</p><nav class='anchorific' data-headings='{{ get_field('otp_heading_tags') }}'></nav>
      @endif
    </aside>
    @endif
    <div class="usa-width-{{ $gridSize }} usa-layout-docs-main_content usa-serif-body">
    @while(have_posts()) @php(the_post())
      @php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<div class="breadcrumbs" id="breadcrumbs">','</div>');
      }
      @endphp
      @include('partials.page-header')
      @include('partials.content-page')
    @endwhile
    </div>
  </main>
@endsection
