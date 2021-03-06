@extends ('major.layout')
@section('title', 'results')
@stop

@section('dropdown','Search Results')
 @stop
{{--the search results page also carries the same layout as the index page. Probably will be fetching from the timeline table. so carries
the important section, lessImportant and noImage stories--}}
@if($data['found']!=0)
@section('important_stories')
<span class="title-timeline" style="color: #646464; margin-bottom:12px; margin-top: 12px">{{$data['found']}} Results found for  '{{$data['search_query']}}'</span><br/>
@foreach($data['search_result'] as $searchResult)
<?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
        <div class="row panel radius">
    <div class="large-12 medium-6 small-12 columns">
         <a href="{{url($tc->makeStoryUrl($searchResult['title'], $searchResult['story_id']))}}">
                @if($searchResult['image_url']!="")
                    <div class="image" style="background-image: url('{{$searchResult['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                 @endif
                <div class="text-details"><a href="{{url($tc->makeStoryUrl($searchResult['title'], $searchResult['story_id']))}}">
                     <header class="title-holder">
                        @if($searchResult['image_url'] == "")
                             <h1 class="title-timeline">{{$searchResult['title']}}</h1>
                        @else
                             <h1 class="title-timeline title-important">{{$searchResult['title']}}</h1>
                        @endif
                     </header></a>
                        <span class="publisher-name">{{$data['publisher_names'][$searchResult['pub_id']]}}</span>
                        {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$top_story['category_id']]}}</b></span>--}}
                         <span class="timecount-name">{{$tc->getTimeDifference($searchResult['created_date'])}}</span>
                </div>
         </a>
    </div>
</div>
@endforeach
@endsection

{{--@section('related_content')--}}
  {{--<div class="row panel radius related-content"><b>Trending Searches</b></div>--}}
  {{--<div class="row panel radius related-content"><b>Related Searches</b></div>--}}
  {{--<div class="row panel radius"><b>Latest in Category</b></div>--}}
{{--@endsection--}}
@else
<span class="title-timeline"><b>Oops!No Results Found</b></span>
@endif


