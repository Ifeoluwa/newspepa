@extends('admin.layout')

@section('title', 'Add New Story | Newspepa')
@stop

@section('more-resources')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="{{url('newspepa_cms/css/editor.css')}}" type="text/css" rel="stylesheet"/>
@stop

@section('icon', 'fa-plus')
@stop

@section('beadcrumb-header', 'Add New Story') @stop

@section('main-content')
<div>

</div>

 <div class="col-lg-9">
    <div class="panel">
          <header class="panel-heading">
              Add New Story
          </header>
          <div class="panel-body">
              <form class="form form-horizontal" method="POST" action="">
                  {!! csrf_field() !!}
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Add Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Add Description</label>

                      <div class="col-sm-10 form-control" id="txtEditor">
                      </div>
                    </div>

              </form>


          </div>
    </div>


 </div>


 @stop


@section('scripts')

<script src="{{url('newspepa_cms/js/editor.js')}}"></script>

<script type="text/javascript">
$(document).ready( function() {
       $("#txtEditor").Editor();
   });
</script>

@stop
