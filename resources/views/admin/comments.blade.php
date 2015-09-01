@extends('admin.layout')

@section('title', 'Comments | Newspepa')
@stop

@section('more-resources')

    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet"/>
@stop

@section('page-header-icon', 'fa-comment') @stop

@section('page-header', 'Comments')
@stop

@section('icon', 'fa-comment')
@stop

@section('beadcrumb-header', 'Comments') @stop


@section('main-content')
@include('admin.partials.success')
@include('admin.partials.failure')
@include('admin.partials.info')
<div id="notification"></div>
<table id="commentsTable" class="table table-hover">
    <thead>
        <tr>
            <th>Story Title</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Time</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['comments'] as $row)
    <tr id="{{'row'.$row['id']}}">
        <td class="col-md-3">{{$row['title']}}</td>
        <td>{{$row['user_name']}}</td>
        <td class="col-md-4">{{$row['comment']}}</td>
        <?php $tc = new \App\Http\Controllers\TimelineStoryController(); ?>
        <td class="col-md-4">{{$tc->getTimeDifference($row['created_date'])}}</td>

        <td id="{{'status'.$row['id']}}">
        @if($row['status_id'] === 2)
        <span class="label label-default">Inactive</span>
        @else
         <span class="label label-success">Active</span>
        @endif
        </td>
        <td id="{{'action'.$row['id']}}">
            <a data-approve="{{$row['id']}}" class="confirmApprove">Approve</a>
        </td>
        <td id="{{'action'.$row['id']}}">
            <a data-disapprove="{{$row['id']}}" class="confirmDisapprove">Disapprove</a>
                     </td>
        <td id="{{'delete'.$row['id']}}">
            <a data-delete="{{$row['id']}}" class="deleteComment">Delete</a>
        </td>

    </tr>
    @endforeach
    </tbody>

</table>
{!! $data['comments']->render() !!}


 <div class="modal fade" id="confirmApproveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="title">Confirm Approve</h4>
       </div>
       <div id="modalBody" class="modal-body">
            Are you sure your want to <strong>approve</strong> this comment?
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         <a id="approveCommentButton" href="" type="button" class="btn btn-primary">Yes</a>
       </div>
     </div>
   </div>
 </div>
 <div class="modal fade" id="confirmDisapproveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="title">Confirm Approve</h4>
        </div>
        <div id="modalBody" class="modal-body">
             Are you sure your want to <strong>disapprove</strong> this comment?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <a id="disapproveCommentButton" href="" type="button" class="btn btn-primary">Yes</a>
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
     $('.confirmApprove').click(function(){
        var comment_id = $(this).data('approve');
        var app_url = "{{url('admin/comment/approve')}}/"+comment_id;
        $.get(app_url, function(data){
            if(data === "1"){
                $('#status'+comment_id).empty().append('<span class="label label-success">Active</span>');
                $('#notification').empty().append('<div class="alert alert-info alert-dismissible">' +
                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                  '<span aria-hidden="true">&times;</span></button><strong>Notice:</strong> Comment has been approved<br><br></div>');
            }

        });
     });

     $('.confirmDisapprove').click(function(){
         var comment_id = $(this).data('disapprove');
         var dsp_url = "{{url('admin/comment/disapprove')}}/"+comment_id;
         $.get(dsp_url, function(data){
            if(data === "1"){
                $('#status'+comment_id).empty().append('<span class="label label-default">Inactive</span>');
                $('#action'+comment_id).empty().append('<a data-id="'+comment_id+'" class="confirmApprove">Approve</a>');
                $('a').on('click', '.confirmApprove', function(){
                var comment_id = $(this).data('id');
                        var app_url = "{{url('admin/comment/approve')}}/"+comment_id;
                        $.get(app_url, function(data){
                            if(data === "1"){
                                $('#status'+comment_id).empty().append('<span class="label label-success">Active</span>');
                                $('#notification').empty().append('<div class="alert alert-info alert-dismissible">' +
                                                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                                  '<span aria-hidden="true">&times;</span></button><strong>Notice:</strong> Comment has been disapproved<br><br></div>');
                            }

                        });
                });
            }
         });
      });



     $('.deleteComment').click(function(){
        var comment_id = $(this).data('delete');


        var table  = $('#commentsTable').DataTable();
        table.row('#row'+comment_id).remove().draw( false )

        var del_url = "{{url('admin/comment/delete')}}/"+comment_id;

        $.get(del_url, function(data){
            if(data === "1"){
                $('#notification').empty().append('<div class="alert alert-info alert-dismissible">' +
                 '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                  '<span aria-hidden="true">&times;</span></button><strong>Notice:</strong> Comment has been deleted<br><br></div>');
            }
        });
        });
   $('#commentsTable').DataTable();



});




</script>
@stop