@extends('admin.layout')

@section('title', 'Dashboard | Newspepa')
@stop

@section('more-resources')

    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet"/>
@stop

@section('page-header-icon', 'fa-laptop') @stop

@section('page-header', 'Dashboard')
@stop

@section('icon', 'fa-home')
@stop

@section('beadcrumb-header', 'Dashboard') @stop


@section('main-content')

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-eye"></i>
						<div class="count">{{$data['story_stats']['today_views']}}</div>
						<div class="title">Today Views</div>
					</div><!--/.info-box-->
				</div><!--/.col-->

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box brown-bg">
						<i class="fa fa-link"></i>
						<div class="count">{{$data['story_stats']['today_linkouts']}}</div>
						<div class="title">Today Linkouts</div>
					</div><!--/.info-box-->
				</div><!--/.col-->

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box dark-bg">
						<i class="fa fa-eye"></i>
						<div class="count">{{$data['story_stats']['total_views']}}</div>
						<div class="title">Total Views</div>
					</div><!--/.info-box-->
				</div><!--/.col-->

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box green-bg">
						<i class="fa fa-link"></i>
						<div class="count">{{$data['story_stats']['total_linkouts']}}</div>
						<div class="title">Total Linkouts</div>
					</div><!--/.info-box-->
				</div><!--/.col-->
<table id="storyTable" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Publisher</th>
            <th>Date</th>
            <th>Views</th>
            <th>Link outs</th>
            <th>Rank Score</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data['stories'] as $row)
    <tr>
        <td>{{$row['title']}}</td>
        <td>{{$data['categories'][$row['category_id']]}}</td>
        <td>{{$data['publishers'][$row['pub_id']]}}</td>
        <td>{{$row['created_date']}}</td>
        <td>{{$row['no_of_views']}}</td>
        <td>{{$row['link_outs']}}</td>
        <td>{{$row['rank_score']}}</td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $data['stories']->render() !!}

@stop


@section('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#storyTable').DataTable();
});
</script>
@stop