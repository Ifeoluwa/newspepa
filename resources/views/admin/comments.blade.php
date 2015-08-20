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
<table id="commentsTable" class="table table-hover">
    <thead>
        <tr>
            <th>Story Title</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['comments'] as $row)
    <tr>
        <td>{{$row['title']}}</td>
        <td>{{$row['user_name']}}</td>
        <td>{{$row['comment']}}</td>

        <td>
        @if($row['status_id'] === 2)
        <span class="label label-default">Inactive</span>
        @else
         <span class="label label-success">Active</span>
        @endif
        </td>
        <td>
            @if($row['status_id'] === 2)
            <a data-val="{{url('admin/comment/approve/'.$row['id'])}}" class="confirmApprove" href="#">Approve</a>
            @else
            <a data-val="{{url('admin/comment/disapprove/'.$row['id'])}}" class="confirmDisapprove" href="#" >Disapprove</a>
            @endif
            <a data-val="{{url('admin/comment/delete/'.$row['id'])}}" class="confirmDelete" href="#">Delete</a>
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
        var del_url = $(this).data('val');
        $('#approveCommentButton').attr('href', del_url);
        $('#confirmApproveModal').modal('show');
     });

     $('.confirmDisapprove').click(function(){
         var del_url = $(this).data('val');
         $('#confirmDisapproveModal').attr('href', del_url);
         $('#confirmDisapproveModal').modal('show');
      });
    $('#commentsTable').DataTable();

});

</script>
@stop