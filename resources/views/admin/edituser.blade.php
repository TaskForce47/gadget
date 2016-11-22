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
        <li><a href="{{url('adminbereich')}}">Admin Bereich</a></li>
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
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="roleId">Roles</label>
                    @foreach($roles as $role)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="roleId{{ $role->id }}"
                                    @if(in_array($role->name, $userRoles))checked
                                    @endif>
                               {{ $role->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <!-- /.box -->
</section>
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