@extends('layouts.app')

@section('content')
  <main class="usa-grid usa-section usa-content usa-layout-docs" id="main-content">
    @php ($gridSize = 'one-whole')
    @if ( !get_field('otp_hide') )
    @php ($gridSize = 'three-fourths')
    <aside class="usa-width-one-fourth usa-layout-docs-sidenav sticky"><p class='usa-layout-docs-sidenav-title'>On this page:</p><nav class='anchorific' data-headings='{{ get_field('otp_heading_tags') }}'></nav></aside>
    @endif
    <div class="usa-width-{{ $gridSize }} usa-layout-docs-main_content">
    @while(have_posts()) @php(the_post())
      @php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p class="breadcrumbs" id="breadcrumbs">','</p>');
      }
      @endphp
      @include('partials.page-header')
      @include('partials.content-page')
    @endwhile
    </div>
  </main>
@endsection
