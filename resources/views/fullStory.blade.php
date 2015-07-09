{{--{{json_encode($data)}}--}}
@extends('layout')

@section('title', 'story')
@endsection

@foreach($data['full_story'] as $full_story1)
@section('dropdown',$data['category_names'][$full_story1['category_id']])
@endsection
@endforeach


@section('full_story')
@foreach($data['full_story'] as $full_story)

<?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
  <div class="row panel radius" style="padding:0.95rem">
      <div class="large-12 medium-12 small-12 columns" style="padding-bottom: 2.0rem">
          <span style="font: 24px Roboto; text-align: justify;font-weight:bolder">{{$full_story['title']}}.</span><br/>
          <span class="publisher-name">{{$data['publisher_names'][$full_story['pub_id']]}}|{{$data['category_names'][$full_story['category_id']]}}</span>
      </div><br/><br/>
      @if($full_story['image_url'] != "")
      <div class="large-12 medium-12 small-12 columns"><img  src="{{$full_story['image_url']}}" style="width:100%; border-radius:2px"/></div>
      @endif
      <div class="large-12 medium-12 small-12 columns"><p><p class="full-story-text">{{$full_story['description']}}...<a href="{{$full_story['url']}}" style="color: #333366">Continue to read</a></p></p>
      </div>
  </div>

   <footer class="footer">
      <div class="_2ip_" id="feedback_inline_896223087101322" data-sigil="mufi-inline">
      <div class="likecounter" id="counts_feedback">
      <a href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=#################" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;">
      <span class="likespan" id="u_6_i"><span></span></span></a></div>
      <div class="shareboxdiv"><div class="sharebox">
<div class="fb-like" data-href="{{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
</div>

      <div class="sharebox"><i class="twittericon"></i><a class="_15kq" href="https://twitter.com/share?url={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&text={{$full_story['title']}}&via=newspepa" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Tweet</a></div>
      <div class="sharebox"><i class="fbicon"></i><a class="_15kr"  href="https://www.facebook.com/dialog/share?app_id=1681272065426030&display=popup&href={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}&redirect_uri={{url($tc->makeStoryUrl($full_story['title'], $full_story['story_id']))}}" >Share</a>
      </div></div></div></footer>
@endforeach
@endsection


@endsection


@section('other_sources')
@if($full_story['is_pivot']==1)
<div class="row panel radius"><b>OTHER SOURCES</b></div>
@foreach($data['other_sources'] as $other_sources)
    <div class="row panel radius">
    <span>{{$data['publisher_names'][$other_sources['pub_id']]}}|{{$other_sources['url']}}</span>
    </div>
@endforeach
@endif
@stop

@section('related_content')
<div class="row panel radius"><b>RECENT STORIES</b></div>
@foreach($data['recent_stories'] as $recent_stories)
    <div class="row panel radius">
          <div class="large-5 small-4 columns" style="width: 100%;">
             <a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
                <div class="smallimage_container">
                @if($recent_stories['image_url'] != "")
                   <div class="smallimage"><img width="120" height="100" src="{{$recent_stories['image_url']}}"/>
                   </div>
                   @endif

                  <a href="{{url($tc->makeStoryUrl($recent_stories['title'], $recent_stories['story_id']))}}">
                   <h1 class="title">{{$recent_stories['title']}} </h1>
                   </a>
                   <span class="publisher-name">{{$data['publisher_names'][$recent_stories['pub_id']]}}</span>
                  <span class="label" style="margin-top:6px"><i class="time-icon"></i>{{$tc->getTimeDifference($recent_stories['created_date'])}} ago</span>
                </div>
                 </a>

</div>
</div>
@endforeach
 @stop
