@extends('layouts.app')

@section('content')

<main class="usa-grid usa-section usa-content usa-layout-docs" id="main-content">

  <div class="usa-width-one-whole alert alert-warning">
    @include('partials.page-header')
    <p class="usa-font-lead">
    {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </p>
    <h3>Search this site:</h3>
    @include('partials.search', ['thisSite' => true])
  </div>

</main>
@endsection
