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
            <li><a href="#"><i class="fa fa-server"></i> Server</a></li>
            <li class="active">Server Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Server Configs</h3>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{url('servermanager/edit/0')}}">
                        <i class="fa fa-plus fa-lg"></i> Add Server</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gadget Name</th>
                        <th>Name</th>
                        <th>Mission</th>
                        <th>Operations</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($server_config as $sv)
                        <tr>
                            <td>{{ $sv->id }}</td>
                            <td>{{ $sv->name }}</td>
                            <td>{{ $sv->gadget_name }}</td>
                            <td>{{ $sv->mission }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-success" href="{{ url('servermanager/run', [$sv->id]) }}">
                                        <i class="fa fa-play" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{ url('servermanager/stop', [$sv->id]) }}">
                                        <i class="fa fa-stop" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url('servermanager/edit', [$sv->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-serverid="{{$sv->id}}" data-servername="{{$sv->name}}"
                                       href="#delServerModal">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                            <td style="text-align: center;"><span class="label label-success">Running</span></td>
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
    <div id="delServerModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delServer.form', 'method' => 'post']) !!}
            <input type="hidden" name="serverId" id="serverId" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Server Config</h4>
                </div>
                <div class="modal-body">
                    <div id="delServerName"></div>
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
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "sEmptyTable":      "Keine Daten in der Tabelle vorhanden",
                    "sInfo":            "_START_ bis _END_ von _TOTAL_ Einträgen",
                    "sInfoEmpty":       "0 bis 0 von 0 Einträgen",
                    "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                    "sInfoPostFix":     "",
                    "sInfoThousands":   ".",
                    "sLengthMenu":      "_MENU_ Einträge anzeigen",
                    "sLoadingRecords":  "Wird geladen...",
                    "sProcessing":      "Bitte warten...",
                    "sSearch":          "Suchen",
                    "sZeroRecords":     "Keine Einträge vorhanden.",
                    "oPaginate": {
                        "sFirst":       "Erste",
                        "sPrevious":    "Zurück",
                        "sNext":        "Nächste",
                        "sLast":        "Letzte"
                    },
                    "oAria": {
                        "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
                        "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
                    }
                }
            });
        });
    </script>


    <script>
        $( "button" ).click(function() {
            $( "p" ).slideToggle( "slow" );
        });
    </script>

    <script>
        $('#delServerModal').on('show.bs.modal', function (e) {

            var serverId = $(e.relatedTarget).data('serverid');
            var serverName = $(e.relatedTarget).data('servername');
            console.log(serverName);
            $(e.currentTarget).find('input[name="serverId"]').val(serverId);

            var textIns = 'Are you sure you want to delete the group ';
            var textIns2 = ' ?';
            serverName = (textIns.concat(serverName)).concat(textIns2);
            $('#delServerName').text(serverName)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection