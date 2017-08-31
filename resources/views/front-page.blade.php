@extends('layouts.app')

@section('content')
  <main id="main-content" class="usa-content">
    @while(have_posts()) @php(the_post())
      @include('partials.content-page')
    @endwhile
  </main>
@endsection