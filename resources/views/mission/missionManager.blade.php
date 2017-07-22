@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Missionen Verwaltung
            <small>Missionen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
            <li><i class="fa fa-gamepad"></i> Missionen</li>
            <li class="active">Missionen Verwaltung</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('missions/0/edit')}}">
                    <i class="fa fa-plus fa-lg"></i> Mission hinzufügen</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-search="true" data-show-toggle="false" data-show-columns="true"
                       data-row-style="rowStyle" data-toolbar="#toolbar" data-mobile-responsive="true" data-locale="de-DE"
                       data-check-on-init="true">
                    <thead>
                    <tr>
                        <th>Mission ID</th>
                        <th>Name</th>
                        <th>Aktiv</th>
                        <th>Akionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($missions as $mission)
                        <tr>
                            <td>{{ $mission->mission_id }}</td>
                            <td>{{ $mission->name }}</td>
                            <td>{{ $mission->active ? 'Ja' : 'Nein' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('missions', [$mission->id, 'edit']) }}">
                                        <i class="fa fa-pencil" title="Mission bearbeiten"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du die Mission "{{$mission->name}}" löschen willst?'
                                            data-id="{{$mission->id}}">
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
                    window.location.href = '/missions/' + $(this).data('id') + '/delete';
                }
            });
        });
    </script>
@endsection