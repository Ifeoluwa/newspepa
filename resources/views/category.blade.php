{{--@extends('layout')--}}
@if($data['is_opera'] == false)
@extends('layout')

@else
@extends('opera-body')
@extends ('opera-header')

@endif

@section ('title',$data['category_stories']['category_name'] )
@endsection

@section('important_stories')
{{--<span style="font-size:x-large;text-align: center; font-family: Roboto ;float:center" ><b>In {{$data['category_stories']['category_name']}}</b></span><br/>--}}
 @foreach($data['category_stories']['all'] as $category_story)
    {{--@if($top_story['browserType']=='operamini')--}}
        <div class="row opera-panel radius">
    {{--@else--}}
        {{--<div class="row panel radius">--}}
    {{--@endif--}}
         <div class="large-12 medium-6 small-12 columns">
            <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
                 <a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                    <div class="image_container">
                    @if($category_story['image_url'] != "")
                       <div class="image" style="background-image: url('{{$category_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                    @endif
                        <div class="text-details"><a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                         <header class="title-holder">
                         @if($category_story['image_url'] == "")
                         <h1 class="title">{{$category_story['title']}}</h1>
                         @else
                            <h1 class="title title-important">{{$category_story['title']}}</h1>@endif
                         </header></a>
                         <span class="publisher-name"><i class="newspapericon"></i><b>{{$data['publishers_name'][$category_story['pub_id']]}}</b></span>
                         <span class="timecount-name"><i class="time-icon"></i><b>{{$tc->getTimeDifference($category_story['created_date'])}} ago</b></span>


                       </div>

                    </div>
                           </a>

         </div>
      </div>
      {{--</div>--}}
  @endforeach
@stop
{{--@section('related_content')--}}
  {{--<div class="row panel radius"><b>Other Sources</b></div>--}}
  {{--<div class="row panel radius"><b>Related Stories</b></div>--}}
  {{--<div class="row panel radius"><b>Latest in Category</b></div>--}}


{{--@endsection--}}