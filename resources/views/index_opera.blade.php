
@extends('layout')
@section('title', 'Breaking Nigerian News From Top Sites')
@stop
{{--@section('dropdown','Top Stories')--}}
{{--@stop--}}

@section('important_stories')
    @foreach($data['timeline_stories']['top_stories'] as $top_story)
    <?php $tc = new \App\Http\Controllers\TimelineStoryController();
    ?>
        {{--@if($top_story['browserType']=='operamini')--}}
            <div class="row opera-panel radius">
              <div class="large-12 medium-6 small-12 columns">
                                <a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                                 @if($top_story['image_url']!="")
                                     <div class="image" style="background-image: url('{{$top_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                                 @endif
                                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">
                                      <header class="title-holder">
                                     @if($top_story['image_url'] == "")
                                       <h1 class="title">{{$top_story['title']}}</h1>
                                       @else
                                          <h1 class="title title-important">{{$top_story['title']}}</h1>
                                      @endif
                                      </header></a>
                                       <span class="publisher-name"><i class="newspapericon"></i><b>{{$data['publishers_name'][$top_story['pub_id']]}}</b></span>
                                      {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$top_story['category_id']]}}</b></span>--}}
                                       <span class="timecount-name"><i class="time-icon"></i><b>{{$tc->getTimeDifference($top_story['created_date'])}} ago</b></span>
                                  </div>
                                </a>
                                </div>
              {{--@endif--}}
              </div>
              {{--</div>--}}
            @endforeach



            {{--{!! $paginator->render() !!}--}}
@stop

{{--@else--}}
         {{--<div class="row panel radius">--}}
         {{--@endif--}}
         {{--@if($tc->isOldStory($top_story['created_date']))--}}
         {{--<a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">--}}
            {{--<div class="large-5 small-4 columns" style="width: 100%;">--}}
                {{--@if($top_story['image_url']!="")--}}
                {{--<div class="smallimage"><img src="{{$top_story['image_url']}}" />--}}
                {{--</div>--}}
              {{--@endif--}}
                    {{--<a href="{{url($tc->makeStoryUrl($top_story['title'], $top_story['story_id']))}}">--}}
                        {{--<h1 class="title">{!!$top_story['title']!!} </h1>--}}
                        {{--<div class="storyExtras">--}}
                         {{--<span class="publisher-name" style="float:left; margin-bottom: 1px"><i class="newspapericon"></i><b>{{$data['publishers_name'][$top_story['pub_id']]}}</b></span>--}}
                         {{--<span class="label" style="margin-top:6px; margin-bottom:1px"><i class="time-icon"></i>{{$tc->getTimeDifference($top_story['created_date'])}} ago</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
            {{--</div>--}}
            {{--</a>--}}

          {{--@else--}}