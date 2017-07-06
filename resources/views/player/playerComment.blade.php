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
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li>Player Management</li>
            <li class="active">Player Manager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div id="toolbar" class="btn-group">
                <a class="btn btn-success" href="{{ url('players/', [$player->id, 'comments/0/edit'])}}">
                    <i class="fa fa-plus fa-lg"></i> Add Whitelist</a>
                </button>
            </div>
            <div class="box-body">
                <table  id="table" data-toggle="table" data-search="true" data-show-toggle="true" data-show-columns="true"
                        data-toolbar="#toolbar" data-row-style="rowStyle">
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
                            <td id="idRow{{$loop->index}}" data-id="{{$comment->deleted}}">{{ $comment->id }}</td>
                            <td>{{ $comment->comment }}</td>
                            @if ($comment->wihtelist_id == 0)
                                <td> Allgemein </td>
                            @else
                                <td> {{ $comment->whitelist()->name }}</td>
                            @endif

                            <td>{{ $comment->author()->get()[0]->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('players',
                                        [$player->id, 'comments/edit', $comment->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Player"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" href="{{ url('players', [$player->id,
                                        'comments/delete', $comment->id]) }}">
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

        function rowStyle(row, index) {
            if($('#idRow' + index).data('id') == 1) {
                return {
                    css: {"background-color": '#f2dede' }
                };
            } else {
                return {
                    css: {"background-color": '' }
                };;
            }
        };

    </script>
@endsection