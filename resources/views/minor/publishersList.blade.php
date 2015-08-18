@extends('minor.opera-layout')
@section('title','Publishers')
@endsection


@section('publishers')
<div class="row" style="color: #646464;; text-align: center">
<span style="font-size: 18px"><b>Select a publisher</b></span>
</div>
<div class="row opera-panel radius" style="color:#008744 ">
                  <span><a href="{{url('/latest-punch-news')}}">Punch</a></span><hr/>
                  <span><a href="{{url('/latest-vanguard-news')}}">Vanguard</a></span><hr/>
                  <span><a href="{{url('/latest-linda-ikeji-news')}}">Linda Ikeji</a></span><hr/>
                  <span><a href="{{url('/latest-nigerian-tribune-news')}}">Nigerian Tribune</a></span><hr/>
                  <span><a href="{{url('/latest-nigerian-monitor-news')}}">Nigerian Monitor</a></span><hr/>
                   <span><a href="{{url('/latest-leadership-news')}}">Leadership</a></span><hr/>
                   <span><a href="{{url('/latest-bella-naija-news')}}">Bella Naija</a></span><hr/>
                   <span><a href="{{url('/latest-channels-tv-news')}}">Channels TV</a></span><hr/>
                   <span><a href="{{url('/latest-goal-com-news')}}">Goal</a></span><hr/>
                  <span><a href="{{url('/latest-the-guardian-news')}}">The Guardian</a></span><hr/>
                  <span><a href="{{url('/latest-kokofeed-news')}}">KokoFeed</a></span><hr/>
                  <span><a href="{{url('/latest-net-news')}}">Net</a></span><hr/>
                  <span><a href="{{url('/latest-star-gist-news')}}">Stargist</a></span><hr/>
                  <span><a href="{{url('/complete-sports')}}">Complete Sports</a></span><hr/>
                  <span><a href="{{url('/latest-daily-post-news')}}">Daily Post</a></span><hr/>
                  <span><a href="{{url('/latest-premium-times-news')}}">Premium times</a></span><hr/>
                  <span><a href="{{url('/latest-business-day-news')}}">Business day</a></span><hr/>
                  <span><a href="{{url('/latest-city-people-news')}}">City People</a></span><hr/>
                  <span><a href="{{url('/latest-encomium-news')}}">Encomium</a></span><hr/>
                  <span><a href="{{url('/latest-bbc-hausa-news')}}">BBC Hausa</a></span></hr>
                  <span><a href="{{url('/latest-the-nation-news')}}">The Nation</a></span></hr>
                  <span><a href="{{url('/latest-naira-metrics-news')}}">Naira Metrics</a></span><hr/>
                  <span><a href="{{url('/latest-business-news-news')}}">Business News</a></span><hr/>

</div>
@endsection