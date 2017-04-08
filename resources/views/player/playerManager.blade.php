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
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Player Management</a></li>
            <li class="active">Player Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Player</h3>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ url('players/edit/0')}}">
                        <i class="fa fa-plus fa-lg"></i> Add Player</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Arma 3 Player ID</th>
                        <th>Team</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->player_id }}</td>
                            <td>{{ $player->team == null ? '' : $player->team->title }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('players/edit', [$player->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Player"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-playerid="{{$player->id}}" data-playername="{{$player->name}}" href="#delplayermodal">
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
    <div id="delplayermodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delPlayer.form', 'method' => 'post']) !!}
            <input type="hidden" name="playerid" id="playerid" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Player</h4>
                </div>
                <div class="modal-body">
                    <div id="delplayername"></div>
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
        $('#delplayermodal').on('show.bs.modal', function (e) {

            var playerId = $(e.relatedTarget).data('playerid');
            var playerName = $(e.relatedTarget).data('playername');
            console.log(playerName);
            $(e.currentTarget).find('input[name="playerid"]').val(playerId);

            var textIns = 'Are you sure you want to delete the Player "';
            var textIns2 = '" ?';
            playerName = (textIns.concat(playerName)).concat(textIns2);
            $('#delplayername').text(playerName)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection