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
        <li><a href="{{url('adminbereich')}}"><i class="fa fa-wrench"></i> Admin Bereich</a></li>
        <li><a href="{{url('groupmanager')}}">Groupmanager</a></li>
        <li class="active">Edit User</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Group</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route'=>'editgroup.form', 'method' => 'post']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Groupname</label>
                    <input type="text" class="form-control" name="groupname" value="{{ $role->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="roleId">Permissions</label>
                    @foreach($allPerms as $perm)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="permId{{ $perm->id }}"
                                    @if($role->permissions->contains($perm))checked
                                    @endif>
                               {{ $perm->name}}
                            </label>
                        </div>
                        @if ($loop->last)
                            <input name="count" type="hidden" value="{{$loop->index}}">
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-default pull-right" href="{{url('groupmanager')}}">Cancel</a>
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