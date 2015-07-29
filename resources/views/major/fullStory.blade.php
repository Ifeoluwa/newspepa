@extends('major.layout')
@foreach($data['full_story'] as $full_story2)
@section('title', $full_story2['title'])
@endsection
@endforeach

@section('more-meta')
<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
<meta property="og:title" content= "{{$full_story2['title']}}"/>
<meta property="og:image" content= "{{$full_story2['image_url']}}"/>
<meta property="og:description" content= "{{$full_story2['description']}}"/>
<meta property="og:url" content= "{{url($tc->makeStoryUrl($full_story2['title'], $full_story2['story_id']))}}"/>
@endsection

@section('full_story')
@foreach($data['full_story'] as $full_story)

<?php $tc = new \App\Http\Controllers\TimelineStoryController();
  ?>
        <div class="row panel radius">
            <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 2.0rem">
              <span class="full-story-title">{{$full_story['title']}}</span><br/>
              <span class="publisher-name">{{$data['publisher_names'][$full_story['pub_id']]}}</span>
              <span class="label" style="margin-top:6px; margin-bottom:1px">{!!$tc->getTimeDifference($full_story['created_date'])!!} </span>

      </div><br/><br/>
      @if($full_story['image_url'] != "")
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
      @endif
      <div class="large-12 medium-12 small-12 columns"><p><p class="full-story-text">{{$full_story['description']}}...<a id="{{$full_story['story_id']}}" name="linkOuts" href="{{$full_story['url']}}" style="color: #0266C8" target="_blank">Continue to read</a></p></p>
      </div>
      <div style="padding-bottom: 5px">
      <div class="fb-share-button" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count"></div>
      <div class="fb-like" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
      <span style="line-height: 1"><a href="whatsapp://send?text={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}"><img src="ui_newspaper/img/whatsapp.png " width="65px" height="25px"/></a></span>
      </div>
         {{--<footer class="footer">--}}
            {{--<div class="_2ip_" id="feedback_inline_896223087101322" data-sigil="mufi-inline">--}}
            {{--<div class="likecounter" id="counts_feedback">--}}
            {{--<a href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=#################" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;">--}}
            {{--<span class="likespan" id="u_6_i"><span></span></span></a></div>--}}
            {{--<div class="shareboxdiv">--}}
              {{--<div class="sharebox">--}}
                  {{--<div class="fb-like" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>--}}
                  {{--</div>--}}
                   {{--<div class="sharebox"><i class="fbicon"></i><a class="_15kr"  href="https://www.facebook.com/dialog/share?app_id=1681272065426030&display=popup&href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&redirect_uri={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" >Share</a>--}}
                   {{--</div>--}}
              {{--</div>--}}
            {{--</div>--}}
         {{--</footer>--}}
  </div>
  {{--</div>--}}


@endforeach
@endsection


{{--@section('other_sources')--}}
{{--@if($full_story['is_pivot']==1)--}}
{{--<div class="row panel radius related-content"><b>other sources</b></div>--}}
{{--@foreach($data['other_sources'] as $other_sources)--}}
    {{--<div class="row panel radius">--}}
   {{--<a name= linkOuts id="{{$other_sources['story_id']}}" href="{{$other_sources['url']}}"> <span>{{$data['publisher_names'][$other_sources['pub_id']]}}|{{$other_sources['url']}}</span></a>--}}
    {{--</div>--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@stop--}}

@section('related_content')
<div class="row panel radius related-content">Latest stories in {{$data['category_names'][$full_story['category_id']]}}</div>
@foreach($data['recent_stories'] as $recent_stories)
        <div class="row panel radius">

     <div class="large-12 medium-6 small-12 columns">
    <a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
     @if($recent_stories['image_url']!="")
         <div class="image" style="background-image: url('{{$recent_stories['image_url']}}'); background-repeat: no-repeat;padding-bottom: 52%;-webkit-background-size: cover;background-size: cover; "></div>
     @endif
          <div class="text-details"><a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
          <header class="title-holder">
         @if($recent_stories['image_url'] == "")
           <h1 class="title-timeline">{{$recent_stories['title']}}</h1>
           @else
              <h1 class="title-timeline title-important">{{$recent_stories['title']}}</h1>
          @endif
          </header></a>
           <span class="publisher-name">{{$data['publisher_names'][$recent_stories['pub_id']]}}</span>
           <span class="timecount-name">{{$tc->getTimeDifference($recent_stories['created_date'])}}</span>
      </div>
    </a>
    </div>

</div>

@endforeach

{{--<div class="row panel radius">--}}
{{--<ul class="inline-list">--}}
{{--<li  style="color:#dc4218; font-weight: bold; font-size:18px">Tell a friend about newspepa</li>--}}
{{--<li><div style="position:relative; margin-bottom: 6px"><div class="fb-share-button" data-href="https://newspepa.com/" data-layout="button_count" style="float:right"></div></div></li>--}}
{{--</ul>--}}
{{--</div>--}}
 @stop

