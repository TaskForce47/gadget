@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Spieler Verwaltung
            <small>Arma Spieler Verwaltung</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
            <li><i class="fa fa-user"></i> Arma Spieler Verwaltung</li>
            <li class="active"> Spieler Verwaltung</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('players/0/edit')}}">
                    <i class="fa fa-plus fa-lg"></i> Spieler hinzufügen</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-locale="de-DE" data-toggle="table" data-search="true" data-show-columns="true"
                       data-toolbar="#toolbar" data-mobile-responsive="true" data-check-on-init="true" data-pagination="true">
                    <thead>
                    <tr>
                        <th data-sortable="true">Arma 3 Player ID</th>
                        <th data-sortable="true">Nickname</th>
                        <th data-sortable="true">Team</th>
                        <th>XML Kommentar</th>
                        <th>Whitelist</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($players as $player)
                        <tr>
                            <td> {{ $player->player_id }}</td>
                            <td> {{ $player->name }}</td>
                            <td> {{ $player->team == null ? '' : $player->team->title }}</td>
                            <td> {{ $player->remark }}</td>
                            <td>
                            @foreach($player->whitelists as $whitelist)
                                    <img src="images/whitelist/{{$whitelist->id}}.png" alt="{{$whitelist->name}}"
                                         title="{{$whitelist->name}}"/>
                            @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default" href="{{ url('players', [$player->id, 'comments']) }}">
                                        <i class="fa fa-commenting-o" title="Kommentare"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url('players', [$player->id, 'edit']) }}">
                                        <i class="fa fa-pencil" title="Spieler bearbeiten"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du den Spieler "{{$player->name}}" löschen willst?'
                                            data-id="{{$player->id}}">
                                        <i class="fa fa-trash" title="Löschen"></i></button>
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
    {!! Html::Script('bootstrap-table/extensions/mobile/bootstrap-table-mobile.js') !!}
    {!! Html::Script('bootstrap-table/locale/bootstrap-table-de-DE.js') !!}
    {!! Html::Script('bootstrap/js/bootstrap-confirmation.js') !!}

    <script>
        $('#table').on('post-body.bs.table', function (data) {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                container: 'body',
                btnOkLabel: 'Ja',
                btnCancelLabel: 'Nein',
                onConfirm:    function () {
                    window.location.href = '/players/' + $(this).data('id') + '/delete';
                }
            });
        });
    </script>
@endsection