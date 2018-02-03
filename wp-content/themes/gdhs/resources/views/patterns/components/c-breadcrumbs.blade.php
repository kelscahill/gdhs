@if (function_exists('yoast_breadcrumb'))
  <div class="c-breadcrumbs">
    @if (is_singular('product'))
      <div class="c-breadcrumb__item u-font--s">
        <span xmlns:v="http://rdf.data-vocabulary.org/#">
          <span typeof="v:Breadcrumb">
            <a href="<?php echo home_url(); ?>/" rel="v:url" property="v:title">Home</a>
            <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
            <span rel="v:child" typeof="v:Breadcrumb">
              <a href="<?php echo home_url(); ?>/shop" rel="v:url" property="v:title">Shop</a>
              <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
              <span class="breadcrumb_last">{{ the_title() }}</span>
            </span>
          </span>
        </span>
      </div>
    @elseif (is_singular('exhibit'))
      <div class="c-breadcrumb__item u-font--s">
        <span xmlns:v="http://rdf.data-vocabulary.org/#">
          <span typeof="v:Breadcrumb">
            <a href="<?php echo home_url(); ?>/" rel="v:url" property="v:title">Home</a>
            <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
            <span rel="v:child" typeof="v:Breadcrumb">
              <a href="<?php echo home_url(); ?>/visit/exhibits" rel="v:url" property="v:title">Exhibitions</a>
              <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
              <span class="breadcrumb_last">{{ the_title() }}</span>
            </span>
          </span>
        </span>
      </div>
    @elseif (is_singular('library'))
      <div class="c-breadcrumb__item u-font--s">
        <span xmlns:v="http://rdf.data-vocabulary.org/#">
          <span typeof="v:Breadcrumb">
            <a href="<?php echo home_url(); ?>/" rel="v:url" property="v:title">Home</a>
            <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
            <span rel="v:child" typeof="v:Breadcrumb">
              <a href="<?php echo home_url(); ?>/research/research-library" rel="v:url" property="v:title">Research Library</a>
              <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
              <span class="breadcrumb_last">{{ the_title() }}</span>
            </span>
          </span>
        </span>
      </div>
    @elseif (is_singular('events'))
      <div class="c-breadcrumb__item u-font--s">
        <span xmlns:v="http://rdf.data-vocabulary.org/#">
          <span typeof="v:Breadcrumb">
            <a href="<?php echo home_url(); ?>/" rel="v:url" property="v:title">Home</a>
            <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
            <span rel="v:child" typeof="v:Breadcrumb">
              <a href="<?php echo home_url(); ?>/visit/events" rel="v:url" property="v:title">Events</a>
              <span class="u-icon u-icon--xs u-icon--arrow--small"></span>
              <span class="breadcrumb_last">{{ the_title() }}</span>
            </span>
          </span>
        </span>
      </div>
    @else
      @php
        yoast_breadcrumb('<div class="c-breadcrumb__item u-font--s">','</div>');
      @endphp
    @endif
  </div>
@endif
