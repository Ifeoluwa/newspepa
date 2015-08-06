@extends('admin.layout')

@section('title', 'Edit or Delete Story | Newspepa')
@stop

@section('more-resources')

    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet"/>
@stop

@section('icon', 'fa-edit')
@stop

@section('beadcrumb-header', 'Edit or Delete Story') @stop


@section('main-content')
@include('admin.partials.success')
@include('admin.partials.failure')
<table id="storyActionsTable" class="table table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['stories'] as $row)
    <tr>
        <td>{{$row['title']}}</td>
        <td>{{$row['created_date']}}</td>
        <td>
            <a href="{{url('admin/story/edit/'.$row['story_id'])}}">Edit</a>
            <a data-val="{{url('admin/story/delete/'.$row['story_id'])}}" class="confirmDelete" href="#" >Delete</a>
        </td>

    </tr>
    @endforeach
    </tbody>

</table>
{!! $data['stories']->render() !!}




 <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="title">Confirm Delete</h4>
       </div>
       <div id="modalBody" class="modal-body">
            Are you sure your want to delete the story?
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         <a id="deleteStoryButton" href="" type="button" class="btn btn-primary">Yes</a>
       </div>
     </div>
   </div>
 </div>
@stop

@section('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#storyActionsTable').DataTable();

    $('.confirmDelete').click(function(){
        var del_url = $(this).data('val');
        $('#deleteStoryButton').attr('href', del_url);
        $('#confirmDeleteModal').modal('show');
    });
});


</script>
@stop