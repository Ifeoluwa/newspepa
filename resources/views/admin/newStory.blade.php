@extends('admin.layout')

@section('title', 'Add New Story | Newspepa')
@stop

@section('more-resources')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style>
      .thumb {
        height: 75px;
        border: 1px solid #000;
        margin: 10px 5px 0 0;
      }
    </style>
@stop

@section('icon', 'fa-plus')
@stop

@section('beadcrumb-header', 'Add New Story') @stop

@section('main-content')

 <div class="col-lg-9">
    <div class="panel">
          <header class="panel-heading">
              Add New Story
          </header>
          <div class="panel-body">
               @include('admin.partials.errors')
               @include('admin.partials.success')

              <form class="form form-horizontal" method="POST" action="{{url('admin/story/create')}}" enctype="multipart/form-data" >
                  {!! csrf_field() !!}
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Add Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Add Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="description" rows="6" id="description">

                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="imageUploads">Upload Images</label>
                      <div class="col-sm-10" id="storyImages">
                         <input name="story_images[]" id="storyImages" class="list-group-item" type="file" multiple="true">
                         <output id="list"></output>
                      </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="publisher">Select Publisher</label>
                        <div class="control-group col-sm-10">
                            @foreach($data['publishers'] as $publisher)
                            <label class="radio-inline">
                              <input type="radio" name="publisher" id="{{$publisher['id']}}" value="{{$publisher['id']}}" required> {{$publisher['name']}}
                            </label>
                            @endforeach

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="category">Select Category</label>
                        <div class="control-group col-sm-10">
                            @foreach($data['categories'] as $category)
                                <label class="radio-inline">
                                  <input type="radio" name="category" id="{{$category['category_name'].$category['id']}}" value="{{$category['id']}}" required> {{$category['category_name']}}
                                </label>
                            @endforeach

                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label" for="scheduled_datetime">Scheduled for</label>--}}
                        {{--<div class="control-group col-sm-10">--}}

                        {{--<div class="checkbox">--}}
                            {{--<label>--}}
                              {{--<input type="checkbox" name="default" checked>  Default (Immediately)--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<input type="datetime-local" class="form-control" name="scheduled_dt">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10 btn-group">
                          <button type="button" id="story_preview"  class="btn btn-default" onclick="launchStoryPreviewModal()">Preview</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>

              </form>


          </div>
    </div>


 </div>

 <div class="modal fade" id="storyPreviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="title">Preview</h4>
       </div>
       <div id="modalBody" class="modal-body">
            <div id="descriptionPreview">

            </div>
            <div id="imagesPreview">

            </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary">Send message</button>
       </div>
     </div>
   </div>
 </div>


 @stop


@section('scripts')

<script src="{{url('newspepa_cms/js/jquery.hotkeys.js')}}"></script>
<script src="{{url('newspepa_cms/assets/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
    function launchStoryPreviewModal(){

        $('#modalBody').empty().append("<h1>"+$('#title').val()+"<h1>");
        $('#modalBody').append(CKEDITOR.instances.description.getData());


        $('#storyPreviewModal').modal('show');
    }

    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

          // Only process image files.
          if (!f.type.match('image.*')) {
            continue;
          }

          var reader = new FileReader();

          // Closure to capture the file information.
          reader.onload = (function(theFile) {
            return function(e) {
              // Render thumbnail.
              var span = document.createElement('span');
              span.innerHTML = ['<img class="thumb img-thumbnail" src="', e.target.result,
                                '" title="', escape(theFile.name), '"/>'].join('');
              document.getElementById('list').insertBefore(span, null);
            };
          })(f);

          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
      }
      document.getElementById('storyImages').addEventListener('change', handleFileSelect, false);



</script>

@stop
