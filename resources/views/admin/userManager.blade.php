@extends('layouts.app')

@section('style')
    {!! Html::Style('bootstrap-table/bootstrap-table.css') !!}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Benutzer Verwaltung
        <small>Admin Bereich</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
        <li><a href="#"><i class="fa fa-wrench"></i> Admin Bereich</a></li>
        <li class="active">Benutzer Verwaltung</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <table id="table" data-toggle="table" data-locale="de-DE" data-search="true" data-show-columns="true"
                   data-mobile-responsive="true" data-check-on-init="true">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Erstellt am</th>
                    <th>Aktualisiert am</th>
                    <th>Gruppen</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    "{{ $role->name }}"
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('users/edit', [$user->id]) }}">
                                        <i class="fa fa-pencil" title="Edit User"></i>
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

@section('script')
    {!! Html::Script('bootstrap-table/bootstrap-table.js') !!}
    {!! Html::Script('bootstrap-table/extensions/mobile/bootstrap-table-mobile.js') !!}
    {!! Html::Script('bootstrap-table/locale/bootstrap-table-de-DE.js') !!}
@endsection