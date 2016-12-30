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
            <li class="active">Player Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Player</h3>
                <div class="pull-right">
                    <a class="btn btn-success" data-toggle="modal" data-target="#addplayermodal" href="#">
                        <i class="fa fa-plus fa-lg"></i> Add Player</a>
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
                    @foreach ($players as $player)
                        <tr>
                            <td>{{ $player->id }}</td>
                            <td>{{ $player->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('whitelists/edit', [$player->id]) }}">
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
    <div id="addplayermodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        {!! Form::open(['route'=>'addPlayer.form', 'method' => 'post']) !!}
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Whitelist</h4>
                </div>
                <div class="modal-body">
                    <label for="playerId">Player ID</label>
                    <input type="text" class="form-control" name="playerId" placeholder="Arma 3 Player ID" required>
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                    <label>Team :
                        <select name="team" class="form-control" required>
                            @foreach($teams as $team)
                                <option>{{$team->name}}</option>
                            @endforeach
                        </select>
                    </label> <br>
                    <label for="remark">Remark</label>
                    <input type="text" class="form-control" name="remark" placeholder="Remark">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" name="email" oncanplay="N/A">
                    <label for="icq">ICQ</label>
                    <input type="text" class="form-control" name="icq" placeholder="N/A">
                    <label for="steam">Steam</label>
                    <input type="text" class="form-control" name="steam" placeholder="N/A">
                    <label for="skype">Skype</label>
                    <input type="text" class="form-control" name="skype" placeholder="N/A">
                    <label>Country :
                        <fieldset>
                            <input type="radio" name="country" value="de" checked>
                            <label for="de"> Deutschland</label> <br>
                            <input type="radio" id="at" name="country" value="at">
                            <label for="at"> Österreich</label> <br>
                            <input type="radio" id="ch" name="country" value="ch">
                            <label for="ch"> Schweiz</label> <br>
                            <input type="radio" id="us" name="country" value="us">
                            <label for="us"> Vereinigte Staaten von Amerika</label> <br>
                        </fieldset>
                    </label>
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

            var whitelistId = $(e.relatedTarget).data('whitelistid');
            var whitelistName = $(e.relatedTarget).data('whitelistname');
            console.log(whitelistName);
            $(e.currentTarget).find('input[name="whitelistid"]').val(whitelistId);

            var textIns = 'Are you sure you want to delete the Player "';
            var textIns2 = '" ?';
            whitelistName = (textIns.concat(whitelistName)).concat(textIns2);
            $('#delwhitelistname').text(whitelistName)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection