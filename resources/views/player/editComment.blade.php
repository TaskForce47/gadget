@extends('layouts.app')

@section('style')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('url')}}">Player Management</a></li>
        <li><a href="{{url('players')}}">Player Manager</a></li>
        <li><a href="{{url('players/comments', [$player->id])}}">Player Manager</a></li>
        <li class="active">Edit Player</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Comment</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'saveComment.form', 'method' => 'post'])}}
        {{Form::hidden('playerDatabaseId', ($player->id))}}
        {{Form::hidden('commentId', ($comment->id == null ? 0 : $comment->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('whitelist', 'Whitelists')}}
                    @php $selectWhitelist[0] = 'Allgemein' @endphp
                    @foreach ($whitelists as $whitelist)
                        @php // TODO: should be done in the controller @endphp
                        @php $selectWhitelist[$whitelist->id] = $whitelist->name @endphp
                    @endforeach
                    {{Form::select('whitelist', $selectWhitelist, $comment->id == null ? 0 : $comment->whitelist_id,
                        array('class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    {{Form::label('comment', 'Kommentar')}}
                    {{Form::text('comment', $comment->comment, array('class' => 'form-control', 'placeholder' =>
                        'Kommentar'))}}
                </div>
                <div class="form-group">
                    {{Form::label('warning', 'Verwarnung')}}
                    {{Form::hidden('warning', 0)}}
                    {{Form::checkbox('warning', 1, $comment->warning)}}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-default pull-right" href="{{url('players', [$player->id,'comments'])}}">Cancel</a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
    <!-- DataTables -->
    <!--
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    -->
    {!! Html::Script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::Script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    <!-- SlimScroll -->
    <!--<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
    {!! Html::Script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
@endsection