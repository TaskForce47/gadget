@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">-->
    {!! Html::Style('/plugins/datatables/dataTables.bootstrap.css') !!}
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
            <li><a href="#"><i class="fa fa-wrench"></i> Whitelists</a></li>
            <li class="active">Whitelist Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Whitelists</h3>
                <div class="pull-right">
                    <a class="btn btn-success" data-toggle="modal" data-target="#addwhitelistmodal" href="#">
                        <i class="fa fa-plus fa-lg"></i> Add Whitelist</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width:100%;">Name</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($whitelists as $wls)
                        <tr>
                            <td>{{ $wls->id }}</td>
                            <td>{{ $wls->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('whitelists/edit', [$wls->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-whitelistid="{{$wls->id}}" data-whitelistname="{{$wls->name}}" href="#delwhitelistmodal">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('modals')

    <!-- Modal -->
    <div id="addwhitelistmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        {!! Form::open(['route'=>'addwhitelist.form', 'method' => 'post']) !!}
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Whitelist</h4>
                </div>
                <div class="modal-body">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Modal -->
    <div id="delwhitelistmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delwhitelist.form', 'method' => 'post']) !!}
            <input type="hidden" name="whitelistid" id="whitelistid" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Whitelist</h4>
                </div>
                <div class="modal-body">
                    <div id="delwhitelistname"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
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
    <!-- FastClick -->
    <!--<script src="../../plugins/fastclick/fastclick.js"></script>-->
    {!! Html::Script('plugins/fastclick/fastclick.js') !!}
    <!-- page script -->
    <script>
        $(function () {
            //$("#example1").DataTable();
            $('#usergrouptable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>

    <script>
        $( "button" ).click(function() {
            $( "p" ).slideToggle( "slow" );
        });
    </script>

    <script>
        $('#delwhitelistmodal').on('show.bs.modal', function (e) {

            var whitelistId = $(e.relatedTarget).data('whitelistid');
            var whitelistName = $(e.relatedTarget).data('whitelistname');
            console.log(whitelistName);
            $(e.currentTarget).find('input[name="whitelistid"]').val(whitelistId);

            var textIns = 'Are you sure you want to delete the group "';
            var textIns2 = '" ?';
            whitelistName = (textIns.concat(whitelistName)).concat(textIns2);
            $('#delwhitelistname').text(whitelistName)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection