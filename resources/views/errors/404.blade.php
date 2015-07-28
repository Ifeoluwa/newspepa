@extends('major.layout')
@section('title', 'Error 404')
@stop

@section('dropdown','Error!')
 @stop
@section('important_stories')

<div class="row opera-panel-404 radius">
<p style="color: #0266C8;font-weight: bolder; font-size:24px">Oops! Looks like the page you are looking for does not exist. :(<p>
<p>To continue viewing Top stories, please click <a href="http://newspepa.com"><b>Here</b></a></p>
  <div class="large-12 medium-6 small-12 columns">
     <div class="image_404"><img src="ui_newspaper/img/newspepa-404.png" style="margin-right: 0 auto"/></div>
     </div>
     </div>
@endsection