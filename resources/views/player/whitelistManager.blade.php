@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Whitelist Verwaltung
            <small>Arma Spieler Verwaltung</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
            <li><i class="fa fa-user"></i> Arma Spieler Verwaltung</li>
            <li class="active"> Whitelist Verwaltung</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('whitelists/0/edit')}}">
                    <i class="fa fa-plus fa-lg"></i> Whitelist hinzufügen</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-locale="de-DE" data-search="true" data-show-columns="true"
                        data-mobile-responsive="true" data-check-on-init="true"
                        data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($whitelists as $wls)
                        <tr>
                            <td>{{ $wls->id }}</td>
                            <td>{{ $wls->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('whitelists', [$wls->id, 'edit']) }}">
                                        <i class="fa fa-pencil" title="Whitelist bearbeiten"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du die Whitelist "{{$wls->name}}" löschen willst?'
                                            data-id="{{$wls->id}}">
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
                    window.location.href = '/whitelists/' + $(this).data('id') + '/delete';
                }
            });
        });
    </script>

@endsection