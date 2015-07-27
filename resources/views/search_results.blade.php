@extends ('layout')
@section('title', 'results')
@stop

<span class="title"><b>"Search Results"</b></span>

{{--the search results page also carries the same layout as the index page. Probably will be fetching from the timeline table. so carries
the important section, lessImportant and noImage stories--}}
@section('important_stories')
@endsection

@section('related_content')
  <div class="row panel radius related-content"><b>Trending Searches</b></div>
  <div class="row panel radius related-content"><b>Related Searches</b></div>
  {{--<div class="row panel radius"><b>Latest in Category</b></div>--}}
@endsection