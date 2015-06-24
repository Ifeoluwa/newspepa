@extends('layout_header')

@section('title', 'NewsPepa|FullStory')
@section('header_content')
@endsection

<div class="row news-item">
    @yield('story_content')
      <div class="large-12 medium-12 small-12 columns">
          <div class="row panel radius">
          <div class="large-12 medium-12 small-12 columns">
          <p><strong>Bacon ipsum dolor sit amet nulla ham qui</strong></p></div>
          <div class="large-12 medium-12 small-12 columns"><img width="300" height="169" src="http://www.techsuplex.com/wp-content/uploads/2015/04/Lenovo-Launch-2-300x169.jpg"/></div>
          <div class="large-12 medium-12 small-12 columns">
          <p> Lenovo, the global PC leader, today reaffirmed its commitment to the Nigerian smartphone market and its customers by introducing a mix of three new stylish and powerful smartphones into the market. The worldâ€™s number
           three smartphone vendor entered the Nigerian market in February last year and the response has been overwhelming. Speaking at breakfast meeting...</p>
           <p><a href="http://www.techsuplex.com/2015/04/30/lenovo-launches-three-smartphones-the-p70-s90-and-s60-in-nigeria">Read more... </a></p>
          </div>
       </div>
       </div>
</div>
@extends('layout_footer')
@section('footer_content')
@endsection