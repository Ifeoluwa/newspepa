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

                        </div>

                    </div>
                  </a>
                  {{--<footer class="footer">--}}
                  {{--<div class="_2ip_" id="feedback_inline_896223087101322" data-sigil="mufi-inline">--}}
                  {{--<div class="likecounter" id="counts_feedback">--}}
                  {{--<a href="http://www.facebook.com/plugins/like.php?href={{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=#################" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;">--}}
                  {{--<span class="likespan" id="u_6_i"><span>1 Like</span></span></a></div>--}}
                  {{--<div class="shareboxdiv"><div class="sharebox">--}}
                  {{--<a class="_15ko touchable _2q8z" href="http://www.facebook.com/plugins/like.php?href={{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}&width&layout=standard&action=like&show_faces=true&share=true&height=80&appId=1681272065426030" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=100,width=200');return false;" id="u_6_c" data-sigil="touchable unlike" data-autoid="autoid_63">Like</a></div>--}}

                  {{--<div class="sharebox"><a class="_15kq" href="https://twitter.com/share?url={{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}&text={{$important_story['title']}}&via=newspepa" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Tweet</a></div>--}}
                  {{--<div class="sharebox"><a class="_15kr" data-store="{&quot;share_id&quot;:896223087101322,&quot;feedback_source&quot;:1,&quot;behavior&quot;:&quot;custom&quot;}" href="https://www.facebook.com/dialog/share?app_id=1681272065426030&display=popup&href={{url($tc->makeStoryUrl($important_story['title'], $important_story['story_id']))}}" data-sigil="share-popup">Share</a></div></div></div></footer>--}}



                  </div>

                  <span class="label">{{""}}</span>


              </div>
            @endforeach
@stop

@section('less_important_stories')

    @foreach($data['timeline_stories']['less_important'] as $less_important_story)
              <div class="row panel radius">
                  <div class="large-5 small-4 columns" style="width: 100%;">


                    <a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">
                      <div class="smallimage_container">
                        <div class="smallimage">
                        <img width="120" height="100" src="{{$less_important_story['image_url']}}"/>
                    </a>
                           {{--<span class="label" style="float:right; align-items: right">{{$less_important_story['no_of_reads']}}reads|{{$tc->getTimeDifference($less_important_story['created_date'])}}</span>--}}


                  <a href="{{url($tc->makeStoryUrl($less_important_story['title'], $less_important_story['story_id']))}}">
                  </a>
</div>
     <h1 class="title">{{$less_important_story['title']}} </h1>
     <span class="publisher-name" style="float:left"><i class="newspapericon"></i><b>{{$data['publishers_name'][$less_important_story['pub_id']]}}</b></span>
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