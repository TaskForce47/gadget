@extends('layouts.app')

@section('style')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Gruppen Verwaltung
        <small>Admin Bereich</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
        <li><i class="fa fa-wrench"></i> Admin Bereich</li>
        <li><a href="{{url('users')}}">Gruppen Verwaltung</a></li>
        @if($role->id == null)
            <li class="active"> Gruppe hinzufügen</li>
        @else
            <li class="active"> Gruppe bearbeiten</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($role->id == null)
            <h3 class="box-title">Gruppe hinzufügen</h3>
            @else
            <h3 class="box-title">Gruppe bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editGroup.form', 'method' => 'post'])}}
        {{Form::hidden('roleId', ($role->id == null ? 0 : $role->id))}}
            <div class="box-body">
                <div class="form-group">
                    {{Form::label('rolename', 'Gruppenname')}}
                    {{Form::text('rolename', $role->name, array('class' => 'form-control', 'placeholder' =>
                        'Gruppenname', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('permissions', 'Rechte:')}} <br>
                    @forelse ($permissions as $permission)
                        {{Form::hidden('permission_' . $permission->id, 0)}}
                        {{Form::checkbox('permission_' . $permission->id, 1,
                            $role->permissions->contains($permission))}}
                        {{Form::label('permission_' . $permission->id, $permission->name)}}
                        <br>
                    @empty
                        Keine Rechte vorhanden<br>
                    @endforelse
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('groups')}}">Abbrechen</a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
@endsection