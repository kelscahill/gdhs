@extends('layouts.app')
@section('content')
  <header class="c-page-header l-container l-narrow u-text-align--center u-spacing--double">
    <div class="u-spacing--half">
      <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Something went wrong</span>
      <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">404</h1>
    </div>
    <hr class="u-hr--small u-hr--black"/>
  </header>
  <article @php post_class('c-article l-container l-narrow l-narrow--l u-spacing--double u-text-align--center') @endphp>
    {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    <a href="/" class="o-button u-button--red u-center-block">Go Home</a>
  </article>
@endsection
