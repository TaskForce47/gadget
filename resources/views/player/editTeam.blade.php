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
        <li><a href="{{url('')}}">Player Management</a></li>
        <li><a href="{{url('teams')}}">Team Manager</a></li>
        @if($team->id == null)
            <li class="active">Add Team</li>
        @else
            <li class="active">Edit Team</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($team->id == null)
                <h3 class="box-title">Add Team</h3>
            @else
                <h3 class="box-title">Edit Team</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editTeam.form', 'method' => 'post'])}}
        {{Form::hidden('teamId', ($team->id == null ? 0 : $team->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('teamTitle', 'Team Name')}}
                    {{Form::text('teamTitle', $team->title, array('class' => 'form-control', 'placeholder' =>
                        'Team Name', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamTag', 'Team Tag')}}
                    {{Form::text('teamTag', $team->nick, array('class' => 'form-control',
                        'placeholder' => 'Team Tag', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamEmail', 'Team E-Mail')}}
                    {{Form::email('teamEmail', $team->email, array('class' => 'form-control',
                        'placeholder' => 'Team E-Mail', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamWebsite', 'Team Website')}}
                    {{Form::text('teamWebsite', "http://task-force47.de/", array('disabled','class' => 'form-control',
                        'placeholder' => 'http://task-force47.de/', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamCommunity', 'Team Community')}}
                    {{Form::text('teamCommunity', '[TF47] Task Force 47 - Die ArmA 3 ACE-Community',
                        array('disabled','class' => 'form-control', 'placeholder' =>
                        '[TF47] Task Force 47 - Die ArmA 3 ACE-Community', 'required' => 'required'))}}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-default pull-right" href="{{url('teams')}}">Cancel</a>
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