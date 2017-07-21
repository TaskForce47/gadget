@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @if($player != null)
                {{$player->name}}
                <small>Kommentare</small>
            @else
                Kommentare
            @endif

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
            <li><i class="fa fa-user"></i> Arma Spieler Verwaltung</li>
            <li><a href="{{url('players')}}"> Spieler Verwaltung</a></li>
            <li><a href="{{url('comments')}}"> Kommentare</a></li>
            @if($player != null)
                <li class="active"> {{$player->name}} - Kommentare</li>
            @endif
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            @if($player != null)
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('players', [$player->id, 'comments', 0, 'edit'])}}">
                    <i class="fa fa-plus fa-lg"></i> Kommentar schreiben</a>
                </button>
            </div>
            @endif
            <div class="box-body">
                <table  id="table" data-locale="de-DE" data-toggle="table" data-search="true" data-show-columns="true"
                        data-toolbar="#toolbar" data-row-style="rowStyle" data-mobile-responsive="true"
                        data-check-on-init="true">
                    <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Spieler</th>
                        <th>Betreff</th>
                        <th>Kommentar</th>
                        <th>Author</th>
                        <th>Aktion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td data-id="{{$comment->deleted}}">{{ $comment->created_at }}</td>
                            <td>{{$comment->player->name}}</td>
                            <td>
                                @if($comment->warning == 1)
                                    <i class="fa fa-exclamation-triangle"></i>
                                @endif
                                &nbsp;
                                @if ($comment->whitelist_id == null)
                                    Allgemein
                                @else
                                    {{ $comment->whitelist->name }}
                                @endif
                            </td>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->author()->get()[0]->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('players',
                                        [$comment->player->id, 'comments', $comment->id, 'edit']) }}">
                                        <i class="fa fa-pencil" title="Kommentar bearbeiten"></i>
                                    </a>
                                    @if($comment->deleted)
                                    <button class="btn btn-success delete-group-class" data-toggle="confirmation_rec"
                                            data-title='Bist du sicher das du diesen Kommentar wiederherstellen willst?'
                                            data-id="{{$comment->id}}" data-playerid="{{$comment->player->id}}">
                                        <i class="fa fa-recycle" title="Wiederherstellen"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du diesen Kommentar löschen willst?'
                                            data-id="{{$comment->id}}" data-playerid="{{$comment->player->id}}">
                                        <i class="fa fa-trash" title="Löschen"></i>
                                    </button>
                                    @endif
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
    {!! Html::Script('bootstrap-table/locale/bootstrap-table-de-DE.js') !!}
    {!! Html::Script('bootstrap-table/extensions/mobile/bootstrap-table-mobile.js') !!}
    {!! Html::Script('bootstrap/js/bootstrap-confirmation.js') !!}

    <script>

        $('#table').on('post-body.bs.table', function (data) {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                container: 'body',
                btnOkLabel: 'Ja',
                btnCancelLabel: 'Nein',
                onConfirm:    function () {
                    window.location.href =
                        '/players/' + $(this).data('playerid') + '/comments/' + $(this).data('id') + '/delete/' +
                            '{{$player == null ? 1 : 0}}';
                }
            });
            $('[data-toggle=confirmation_rec]').confirmation({
                rootSelector: '[data-toggle=confirmation_rec]',
                container: 'body',
                btnOkLabel: 'Ja',
                btnCancelLabel: 'Nein',
                onConfirm:    function () {
                    window.location.href =
                        '/players/' + $(this).data('playerid') + '/comments/' + $(this).data('id') + '/recover/' +
                            '{{$player == null ? 1 : 0}}';
                }
            });
        });

        function rowStyle(row, index) {
            if(row['_0_data'] != null) {
                if (row['_0_data']['id'] == 1) {
                    return {
                        css: {"background-color": '#f2dede'}
                    };
                }
            }
            return {};
        };

    </script>
@endsection