@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-server"></i> Server</a></li>
            <li class="active">Server Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('servermanager/edit/0')}}">
                    <i class="fa fa-plus fa-lg"></i> Add Player</a>
                </button>
            </div>
            <div class="box-body">
                <table id="table" data-toggle="table" data-search="true" data-show-toggle="true" data-show-columns="true"
                       data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-sortable="true">ID</th>
                        <th data-sortable="true">Gadget Name</th>
                        <th data-sortable="true">Name</th>
                        <th data-sortable="true">Mission</th>
                        <th>Operations</th>
                        <th data-sortable="true">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($server_config as $sv)
                        <tr>
                            <td>{{ $sv->id }}</td>
                            <td>{{ $sv->name }}</td>
                            <td>{{ $sv->gadget_name }}</td>
                            <td>{{ $sv->mission }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-success" href="{{ url('servermanager/run', [$sv->id]) }}">
                                        <i class="fa fa-play" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{ url('servermanager/stop', [$sv->id]) }}">
                                        <i class="fa fa-stop" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-info" href="{{ url('servermanager/edit', [$sv->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Group"></i>
                                    </a>
                                    <button class="btn btn-danger delete-group-class" data-toggle="confirmation"
                                            data-title='Bist du sicher das du den Spieler "{{$sv->name}}" löschen willst?'
                                            data-id="{{$sv->id}}">
                                        <i class="fa fa-trash" title="Delete"></i></button>
                                </div>
                            </td>
                            <td style="text-align: center;"><span class="label label-success">Running</span></td>
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
    <div id="delServerModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['route'=>'delServer.form', 'method' => 'post']) !!}
            <input type="hidden" name="serverId" id="serverId" value=""/>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Server Config</h4>
                </div>
                <div class="modal-body">
                    <div id="delServerName"></div>
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
                    window.location.href = '/servermanager/delete/' + $(this).data('id');
                }
            });
        });
    </script>

@endsection