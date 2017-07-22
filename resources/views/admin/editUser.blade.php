@extends('layouts.app')

@section('style')
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
        <li><i class="fa fa-wrench"></i> Admin Bereich</li>
        <li><a href="{{url('users')}}">Benutzer Verwaltung</a></li>
        <li class="active">Benutzer bearbeiten</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Benutzer bearbeiten</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editUser.form', 'method' => 'post'])}}
        {{Form::hidden('userId', ($user->id == null ? 0 : $user->id))}}
            <div class="box-body">
                <div class="form-group">
                    {{Form::label('username', 'Benutzername')}}
                    {{Form::text('username', $user->name, array('class' => 'form-control', 'placeholder' =>
                        'Benutzername', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('roles', 'Gruppen:')}} <br>
                    @forelse ($roles as $role)
                        {{Form::hidden('role_' . $role->id, 0)}}
                        {{Form::checkbox('role_' . $role->id, 1,
                            $user->roles->contains($role))}}
                        {{Form::label('role_' . $role->id, $role->name)}}
                        <br>
                    @empty
                        Keine Gruppen vorhanden<br>
                    @endforelse
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('users')}}">Abbrechen</a>
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