@extends ('minor.opera-layout')
@section ('title',$data['category_stories']['category_name'] )
@endsection


@section('important_stories')
 <?php $tc = new \App\Http\Controllers\TimelineStoryController();?>
@foreach($data['category_stories']['all'] as $category_story)
          <div class="row opera-panel radius">
                <div class="large-12 medium-6 small-12 columns">
                     <a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                        @if($category_story['image_url']!="")
                            <div class="image" style="background-image: url('{{$category_story['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
                        @endif
                      <div class="text-details"><a href="{{url($tc->makeStoryUrl($category_story['title'], $category_story['story_id']))}}">
                      <header class="title-holder">
                     @if($category_story['image_url'] == "")
                       <h1 class="title-timeline">{{$category_story['title']}}</h1>
                       @else
                          <h1 class="title-timeline title-important">{{$category_story['title']}}</h1>
                      @endif
                      </header></a>
                       <span class="publisher-name">{{$data['publishers_name'][$category_story['pub_id']]}}</span>
                      {{--<span class="category-name"><i class="categoryicon"></i><b>{{$data['category_name'][$category_story['category_id']]}}</b></span>--}}
                       <span class="timecount-name"><i class="time-icon"></i><b>{{$tc->getTimeDifference($category_story['created_date'])}} </b></span>
                  </div>
                </a>
                </div>

</div>
            @endforeach
            {!! $data['paginator']->render() !!}
            @stop