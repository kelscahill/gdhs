@if (is_page_template('views/template-events.blade.php') || is_page_template('views/template-past-events.blade.php'))
  @include('patterns.blocks.c-block-events')
@else
  @include('patterns.blocks.c-block-news')
@endif
