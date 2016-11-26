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
            <li><a href="#"><i class="fa fa-dashboard"></i> Server</a></li>
            <li class="active">Server Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Server Configs</h3>
                <div class="pull-right">
                    <a class="btn btn-success" data-toggle="modal" data-target="#addservermodal" href="#">
                        <i class="fa fa-plus fa-lg"></i> Add Server</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped">
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
                            <td>{{ $sv->created_at }}</td>
                            <td>{{ $sv->updated_at }}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('groupmanager/edit', [$sv->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-roleid="{{$sv->id}}" data-rolename="{{$sv->name}}" href="#delgroupmodal">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                            <td></td>
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
    <div id="addservermodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        {!! Form::open(['route'=>'addserver.form', 'method' => 'post']) !!}
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Serverconfig</h4>
                </div>
                <div class="modal-body">
                    <label for="gadgetname">Gadget Name</label>
                    <input type="text" class="form-control" name="gadgetname" placeholder="Gadget Name" required>
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                    <label for="password">Server Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Server Password">
                    <label for="adminpassword">Admin Password</label>
                    <input type="text" class="form-control" name="adminpassword" placeholder="Admin Password" required>
                    <label for="motd">MotD</label>
                    <textarea rows="4" cols="50" class="form-control" name="motd" placeholder="MotD"></textarea>
                    <label for="motdinterval">MotD Interval</label>
                    <input type="number" class="form-control" name="motdinterval" placeholder="0" min="0">
                    <label for="maxplayers">Max Players</label>
                    <input type="number" class="form-control" name="maxplayers" placeholder="1" min="0" required>
                    <label for="kickduplicates">Kick duplicates</label>
                    <input type="checkbox" name="kickduplicates" required>
                    <br>
                    <label for="verifysigs">Verify Signatures</label>
                    <input type="checkbox" name="verifysigs" required>
                    <br>
                    <label for="headlessclients">Headlessclient IPs</label>
                    <input type="text" class="form-control" name="headlessclients" placeholder="127.0.0.1,127.0.0.2">
                    <label for="votemissionp">Vote Mission Players</label>
                    <input type="number" class="form-control" name="votemissionp" placeholder="1" min="0">
                    <label for="votethreshold">Vote Mission Players (%)</label>
                    <input type="number" class="form-control" name="votethreshold" placeholder="0" min="0" max="1" step="0.01">
                    <label for="disablevon">Disable VON</label>
                    <input type="checkbox" name="disablevon">
                    <br>
                    <label for="vonqual">VON Codec Quality</label>
                    <input type="number" class="form-control" name="vonqual" placeholder="10" min="0" max="64">
                    <label for="persistent">Persistent Server</label>
                    <input type="checkbox" name="persistent">
                    <br>
                    <label for="battleye">Enable BattleEye</label>
                    <input type="checkbox" name="battleye">
                    <br>
                    <label for="maxping">Max Ping</label>
                    <input type="number" class="form-control" name="maxping" placeholder="100" min="0">
                    <label for="maxdesync">Max Desync</label>
                    <input type="number" class="form-control" name="maxdesync" placeholder="100" min="0">
                    <label for="maxpacketloss">Max Packetloss (%)</label>
                    <input type="number" class="form-control" name="maxpacketloss" placeholder="0" min="0" max="1" step="0.01">
                    <label for="disconnecttimeout">Disconnect Timeout</label>
                    <input type="number" class="form-control" name="disconnecttimeout" placeholder="90" min="0">
                    <label for="kickslowclients">Kick clients on slow network</label>
                    <input type="checkbox" name="kickslowclients">
                    <br>
                    <label for="doubleidcode">On double id detected code</label>
                    <input type="text" class="form-control" name="doubleidcode" placeholder="command">
                    <label for="userconnectcode">On user connected code</label>
                    <input type="text" class="form-control" name="userconnectcode" placeholder="command">
                    <label for="userdisconnectcode">On user disconnected code</label>
                    <input type="text" class="form-control" name="userdisconnectcode" placeholder="command">
                    <label for="hackeddatacode">On hacked data code</label>
                    <input type="text" class="form-control" name="hackeddatacode" placeholder="command">
                    <label for="diffdatacode">On different data code</label>
                    <input type="text" class="form-control" name="diffdatacode" placeholder="command">
                    <label for="unsigneddatacode">On unsigned data code</label>
                    <input type="text" class="form-control" name="unsigneddatacode" placeholder="command">
                    <label for="regularcheckcode">Regular check doe</label>
                    <input type="text" class="form-control" name="regularcheckcode" placeholder="command">
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
    <div id="delservermodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delserver.form', 'method' => 'post']) !!}
            <input type="hidden" name="roleid" id="roleid" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Groupname</h4>
                </div>
                <div class="modal-body">
                    <div id="delrolename"></div>
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
        $('#delgroupmodal').on('show.bs.modal', function (e) {

            var roleid = $(e.relatedTarget).data('roleid');
            var rolename = $(e.relatedTarget).data('rolename');
            console.log(rolename);
            $(e.currentTarget).find('input[name="roleid"]').val(roleid);

            var textIns = 'Are you sure you want to delete the group ';
            var textIns2 = ' ?';
            rolename = (textIns.concat(rolename)).concat(textIns2);
            $('#delrolename').text(rolename)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection