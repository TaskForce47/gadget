@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ticketlog
            <small>Missions</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Missions</li>
            <li class="active">Ticketlog</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-default" href="{{ url('missions/ticketlog', [$missionId])}}">
                    <i class="fa fa-clock-o fa-lg"></i> Aktuelle Runde</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-search="true" data-show-columns="true"
                       data-row-style="rowStyle" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-sortable="true">Runde</th>
                        <th data-sortable="true">Aktion</th>
                        <th data-sortable="true">Name</th>
                        <th data-sortable="true">Arma 3 Player ID</th>
                        <th data-sortable="true">Team</th>
                        <th data-sortable="true">Spieler</th>
                        <th>Kommentar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($oldRounds as $round)
                        @foreach($round as $entry)
                            <tr>
                                <td>{{$entry->round}}</td>
                                <td data-id="{{$entry->action->color}}">{{ $entry->action->name }}</td>
                                <td>{{ $entry->timestamp }}</td>
                                <td>{{ $entry->change }}</td>
                                <td>{{ $entry->round}}</td>
                                <td>{{ $entry->player != null ? $entry->player->name : "" }}</td>
                                <td>{{ $entry->comment }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table id="historyTable">

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
        function rowStyle(row, index) {
            // http://www.grauw.nl/blog/entry/510
            if(row['_1_data'] != null) {
                if (row['_1_data']['id'] != null) {
                    return {
                        css: {"background-color": row['_1_data']['id']}
                    };
                }
            }
            return {};
        };
    </script>
@endsection