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
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Player Management</li>
            <li class="active">Player Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Player</h3>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ url('players/comments', [$player->id, 'edit',0])}}">
                        <i class="fa fa-plus fa-lg"></i> Add Comments</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kommentar</th>
                        <th>Betreff</th>
                        <th>Author</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->comment }}</td>
                            @if ($comment->wihtelist_id == 0)
                                <td> Allgemein </td>
                            @else
                                <td> {{ $comment->whitelist()->name }}</td>
                            @endif

                            <td>{{ $comment->author()->get()[0]->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default" href="{{ url('players/comments', [$comment->id]) }}">
                                        <i class="fa fa-commenting-o" title="Comments"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url('players',
                                        [$player->id, 'edit', $comment->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Player"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" href="{{ url('players', [$player->id,
                                        'delete', $comment->id]) }}">
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