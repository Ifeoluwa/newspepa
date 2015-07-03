{{--{{json_encode($data}}--}}

@extends('layout')
@section('title', 'Top Stories')
@stop

@section('important_stories')

    @foreach($data['timeline_stories']['important'] as $important_story)
         <div class="row panel radius">
                  <div class="large-12 medium-6 small-12 columns">

                  <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
                  <a href="{{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}">
                    <div class="image_container">
                       <div class="image" style="background-image: url('{{$important_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                       {{--<div class="image" style="background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: 100% 100%;background-size: 100% 100%; "><img src="({{$important_story['image_url']}}"/></div>--}}
                        <div class="text-details"><a href="{{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}">
                        <header class="title-holder">
                        <h1 class="title">{{$important_story['title']}}</h1>
                        </header>
                        </a>
                         <span class="publisher-name"><i class="newspapericon"></i><b>{{$data['publishers_name'][$important_story['pub_id']]}}</b></span>
                         {{--<span class="label">{{$important_story['no_of_reads']}}reads|{{$tc->getTimeDifference($important_story['created_date'])}} ago</span>--}}
                         <span class="label"><i class="reads"></i>{{$important_story['no_of_reads']}}reads</span>
                         <span class="label"><i class="time-icon"></i>{{$tc->getTimeDifference($important_story['created_date'])}}</span>

                        </div>

                    </div>
                  </a>
                  </div>
              </div>
            @endforeach
@stop

@section('less_important_stories')
    @foreach($data['timeline_stories']['less_important'] as $less_important_story)
       <div class="row panel radius">
          <div class="large-5 small-4 columns" style="width: 100%;">
             <a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">
                <div class="smallimage_container">
                   <div class="smallimage"><img width="120" height="100" src="{{$less_important_story['image_url']}}"/></div>
                    </a>
                  <a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">
                   <h1 class="title">{{$less_important_story['title']}} </h1>
                   </a>

                <span class="publisher-name" style="float:left; margin-right: 170px"><i class="newspapericon"></i><b>{{$data['publishers_name'][$less_important_story['pub_id']]}}</b></span>
               <span class="label" style="margin-top:6px;margin-bottom:12px"><i class="reads"></i>{{$less_important_story['no_of_reads']}}reads</span>
                <span class="label" style="margin-top:6px; margin-bottom:12px"><i class="time-icon"></i>{{$tc->getTimeDifference($less_important_story['created_date'])}}</span>
                </div>
</div>

</div>

@endforeach
@stop


@section('stories_with_no_images')
    @foreach($data['timeline_stories']['no_image'] as $no_image_story)
              <div class="row panel radius">
                  <div class="large-12 small-12 columns">
                  <p><a href="{{url($tc->makeStoryUrl($no_image_story['title'], $no_image_story['story_id']))}}"><strong>{{$no_image_story['title']}}</strong></a></p>

                  </div>
                  <span class="label">{{$tc->getTimeDifference($no_image_story['created_date'])}}</span>
              </div>
    @endforeach
@stop