{{--
  Template Name: Blocks Page Template
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
    @php($blocks = get_field('block'))
    @if ($blocks)
      <section class="c-section c-section__blocks l-narrow u-spacing--double">
        @foreach ($blocks as $block)
          @php
            $title = $block['block_title'];
            $excerpt = $block['block_description'];
            $thumb_id = $block['block_image']['id'];
            $img_s = $block['block_image']['sizes']['horiz__4x3--s'];
            $img_m = $block['block_image']['sizes']['horiz__4x3--m'];
            $link = $block['block_url'];
          @endphp
          @include('patterns.blocks.c-block')
        @endforeach
      </section>
    @endif
  @endwhile
@endsection
