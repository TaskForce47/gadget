@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ticketlog
            <small>Missionen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
            <li><i class="fa fa-gamepad"></i> Missionen</li>
            <li class="active">Ticketlog</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-default" href="{{ url('missions/ticketlog', [$missionId, 'old'])}}">
                    <i class="fa fa-clock-o fa-lg"></i> Ältere Runden</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-search="true" data-show-toggle="false" data-show-columns="true"
                       data-row-style="rowStyle" data-toolbar="#toolbar" data-mobile-responsive="true" data-locale="de-DE"
                       data-check-on-init="true">
                    <thead>
                    <tr>
                        <th data-sortable="true">Aktion</th>
                        <th data-sortable="true">Zeitpunkt</th>
                        <th data-sortable="true">Aktuelle Ticketanzahl</th>
                        <th data-sortable="true">Ticketveränderung</th>
                        <th data-sortable="true">Spieler</th>
                        <th>Kommentar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ticketLog as $entry)
                        <tr>
                            <td data-id="{{$entry->action->color}}">{{ $entry->action->name }}</td>
                            <td>{{ $entry->timestamp }}</td>
                            <td>{{ $entry->tickets }}</td>
                            <td>{{ $entry->change}}</td>
                            <td>{{ $entry->player != null ? $entry->player->name : "" }}</td>
                            <td>{{ $entry->comment }}</td>
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
        function rowStyle(row, index) {
            // http://www.grauw.nl/blog/entry/510
            if(row['_0_data'] != null) {
                if (row['_0_data']['id'] != null) {
                    return {
                        css: {"background-color": row['_0_data']['id']}
                    };
                }
            }
            return {};
        };
    </script>
@endsection