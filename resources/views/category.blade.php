@extends('layout')

@section ('title',$data['category_stories']['category_name'] )
@endsection

@section('important_stories')
<span style="font-size:x-large;text-align: center; font-family: Roboto ;float:center" ><b>In {{$data['category_stories']['category_name']}}</b></span><br/>
 @foreach($data['category_stories']['all'] as $category_story)
         <div class="row panel radius">
                  <div class="large-12 small-12 columns">
                  <a href="fullStory2"><img width="300" height="194" src="{{$category_story['image_url']}}"/></a>
                  </div>
                  <div class="large-12 small-12 columns"><p><p><a href="fullStory.blade.php"><strong>{{$category_story['title']}}</strong></a></p></p>
                  </div>
                  <?php $date1 = new DateTime(strtotime($category_story['pub_date']));
                        $date2 = new DateTime();
                        $diff = $date1->diff($date2);
                   ?>
                  <span class="label">{{$diff->format('%a Day and %h hours')}}</span>
                  {{--<span class="label">{{$important_story['pub_date']}}</span>--}}
              </div>
            @endforeach
@stop
@section('related_content')
  <div class="row panel radius"><b>Other Sources</b></div>
  <div class="row panel radius"><b>Related Stories</b></div>
  <div class="row panel radius"><b>Latest in Category</b></div>
@endsection