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
            <li><a href="#"><i class="fa fa-dashboard"></i> Player</a></li>
            <li class="active">Team Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Team</h3>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{url('teams/edit/0')}}">
                        <i class="fa fa-plus fa-lg"></i> Add Tean</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Tag</th>
                        <th>E-Mail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>{{ $team->id }}</td>
                            <td>{{ $team->title }}</td>
                            <td>{{ $team->nick }}</td>
                            <td>{{ $team->email }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('teams/edit', [$team->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Player"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-teamid="{{$team->id}}" data-teamname="{{$team->name}}" href="#delteammodal">
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
    <div id="delteammodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delTeam.form', 'method' => 'post']) !!}
            <input type="hidden" name="teamid" id="teamid" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Team</h4>
                </div>
                <div class="modal-body">
                    <div id="delteamname"></div>
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
        $('#delteammodal').on('show.bs.modal', function (e) {

            var teamId = $(e.relatedTarget).data('teamid');
            var teamName = $(e.relatedTarget).data('teamname');
            console.log(teamName);
            $(e.currentTarget).find('input[name="teamid"]').val(teamId);

            var textIns = 'Are you sure you want to delete the Team "';
            var textIns2 = '" ?';
            teamName = (textIns.concat(teamName)).concat(textIns2);
            $('#delteamname').text(teamName)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection