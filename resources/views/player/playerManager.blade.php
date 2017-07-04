@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Player Manager
            <small>Player Management</small>
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
            <!--
            <div class="box-header">
                <h3 class="box-title">Player</h3>
            </div>
            -->
            <!-- /.box-header -->
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('players/edit/0')}}">
                    <i class="fa fa-plus fa-lg"></i> Add Player</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-search="true" data-show-toggle="true" data-show-columns="true"
                       data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-sortable="true">ID</th>
                        <th data-sortable="true">Name</th>
                        <th data-sortable="true">Arma 3 Player ID</th>
                        <th data-sortable="true">Team</th>
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
                            <td id="test">
                                <div class="btn-group">
                                    <a class="btn btn-default" href="{{ url('players', [$player->id, 'comments']) }}">
                                        <i class="fa fa-commenting-o" title="Comments"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url('players/edit', [$player->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Player"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du den Spieler "{{$player->name}}" löschen willst?'
                                            data-id="{{$player->id}}">
                                        <i class="fa fa-trash" title="Delete"></i></button>
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
    {!! Html::Script('bootstrap-table/bootstrap-table.js') !!}
    {!! Html::Script('bootstrap/js/bootstrap-confirmation.js') !!}
    <!-- SlimScroll -->
    {!! Html::Script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::Script('plugins/fastclick/fastclick.js') !!}
    <!-- page script -->

    <script>

        $('#table').on('post-body.bs.table', function (data) {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                container: 'body',
                btnOkLabel: 'Ja',
                btnCancelLabel: 'Nein',
                onConfirm:    function () {
                    window.location.href = '/players/delete/' + $(this).data('id');
                }
            });
        });
    </script>
@endsection