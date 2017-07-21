@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gruppen Verwaltung
            <small>Admin Bereich</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><i class="fa fa-wrench"></i> Admin Bereich</li>
            <li class="active">Gruppen Verwaltung</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('groups/0/edit')}}">
                    <i class="fa fa-plus fa-lg"></i> Gruppe hinzufügen</a>
                </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" data-toggle="table" data-locale="de-DE" data-search="true" data-show-columns="true"
                       data-mobile-responsive="true" data-check-on-init="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Erstellt am</th>
                        <th>Aktualisiert am</th>
                        <th>Rechte</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                @foreach($role->permissions as $perm)
                                    "{{ $perm->name }}"
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('groups', [$role->id, 'edit']) }}">
                                        <i class="fa fa-pencil" title="Gruppe bearbeiten"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du die Gruppe "{{$role->name}}" löschen willst?'
                                            data-id="{{$role->id}}">
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
                    window.location.href = '/groups/' + $(this).data('id') + '/delete';
                }
            });
        });
    </script>

@endsection