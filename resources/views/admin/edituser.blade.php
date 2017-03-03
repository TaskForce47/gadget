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
        <li><a href="{{url('usermanager')}}">Usermanager</a></li>
        <li class="active">Edit User</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit User</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route'=>'edituser.form', 'method' => 'post']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="roleId">Groups</label>
                    @foreach($allRoles as $role)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="roleId{{ $role->id }}"
                                    @if($user->roles->contains($role))checked
                                    @endif>
                               {{ $role->name}}
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
                <a class="btn btn-default pull-right" href="{{url('usermanager')}}">Cancel</a>
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