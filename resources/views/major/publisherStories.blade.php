@extends('major.layout')
@foreach($data['publisher_stories']['all'] as $publisher_story1)
@section('title', $data['publishers_name'][$publisher_story1['pub_id']])
@endforeach
@stop


@section('important_stories')
@foreach($data['publisher_stories']['all'] as $publisher_story2)
<span class="publisher-name">{{$data['publishers_name'][$publisher_story2['pub_id']]}}</span>
@endforeach
    @foreach($data['publisher_stories']['all'] as $publisher_story)
    <?php $tc = new \App\Http\Controllers\TimelineStoryController();
    ?>
            <div class="row panel radius">
              <div class="large-12 medium-6 small-12 columns">
                <a href="{{url($tc->makeStoryUrl($publisher_story['title'], $publisher_story['story_id']))}}">
                 @if($publisher_story['image_url']!="")
                     <div class="image" style="background-image: url('{{$publisher_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                 @endif
                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($publisher_story['title'], $publisher_story['story_id']))}}">
                      <header class="title-holder">
                     @if($publisher_story['image_url'] == "")
                       <h1 class="title-timeline">{{$publisher_story['title']}}</h1>
                       @else
                          <h1 class="title-timeline title-important">{{$publisher_story['title']}}</h1>
                      @endif
                      </header></a>
                       <span class="timecount-name">{{$tc->getTimeDifference($publisher_story['created_date'])}}</span>
                  </div>
                </a>
                </div>

              </div>
            @endforeach



           {!! $data['paginator']->render() !!}
@stop

