@extends('layouts.app')

@section('style')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Team Verwaltung
        <small>Arma Spieler Verwaltung</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Startseite</a></li>
        <li><i class="fa fa-user"></i> Arma Spieler Verwaltung</li>
        <li><a href="{{url('teams')}}"> Team Verwaltung</a></li>
        @if($team->id == null)
            <li class="active"> Team hinzufügen</li>
        @else
            <li class="active"> Team bearbeiten</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($team->id == null)
                <h3 class="box-title">Team hinzufügen</h3>
            @else
                <h3 class="box-title">Team bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editTeam.form', 'method' => 'post'])}}
        {{Form::hidden('teamId', ($team->id == null ? 0 : $team->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('teamTitle', 'Team Name')}}
                    {{Form::text('teamTitle', $team->title, array('class' => 'form-control', 'placeholder' =>
                        'Team Name', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamTag', 'Team Tag')}}
                    {{Form::text('teamTag', $team->tag, array('class' => 'form-control',
                        'placeholder' => 'Team Tag', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamEmail', 'Team E-Mail')}}
                    {{Form::email('teamEmail', $team->email, array('class' => 'form-control',
                        'placeholder' => 'Team E-Mail', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamDirectory', 'Team Ordner')}}
                    @if($team->id == null)
                        {{Form::text('teamDirectory', $team->directory,  array('class' => 'form-control',
                            'placeholder' => 'Team Ordner', 'required' => 'required'))}}
                    @else
                        {{Form::text('teamDirectory', $team->directory,  array('disabled', 'class' => 'form-control',
                            'placeholder' => 'Team Ordner', 'required' => 'required'))}}
                    @endif
                </div>
                <div class="form-group">
                    {{Form::label('teamWebsite', 'Team Website')}}
                    {{Form::text('teamWebsite', "http://task-force47.de/", array('disabled','class' => 'form-control',
                        'placeholder' => 'http://task-force47.de/', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('teamCommunity', 'Team Community')}}
                    {{Form::text('teamCommunity', '[TF47] Task Force 47 - Die ArmA 3 ACE-Community',
                        array('disabled','class' => 'form-control', 'placeholder' =>
                        '[TF47] Task Force 47 - Die ArmA 3 ACE-Community', 'required' => 'required'))}}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('teams')}}">Abbrechen</a>
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