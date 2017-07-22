@extends('layouts.app')

@section('style')
    {!! Html::style('css/flag-icon.min.css') !!}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mission Verwalten
        <small>Missionen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
        <li><i class="fa fa-user"></i> Missionen</li>
        <li><a href="{{url('missions')}}"> Mission Verwalten</a></li>
        @if($mission->id == null)
            <li class="active"> Mission hinzufügen</li>
        @else
            <li class="active"> Mission bearbeiten</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($mission->id == null)
                <h3 class="box-title">Mission hinzufügen</h3>
            @else
                <h3 class="box-title">Mission bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editMission.form', 'method' => 'post'])}}
        {{Form::hidden('missionDatabaseId', ($mission->id == null ? 0 : $mission->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('missionId', 'Mission ID')}}
                    {{Form::number('missionId', $mission->mission_id, array('class' => 'form-control',
                'placeholder' => 1, 'min' => 1,  'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('name', 'Missionen Name')}}
                    {{Form::text('name', $mission->name, array('class' => 'form-control', 'placeholder' =>
                        'Missionen Name', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('active', 'Mission aktiv:')}} <br>
                    {{Form::hidden('active', 0)}}
                    {{Form::checkbox('active', 1, $mission->active)}}
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('missions')}}">Abbrechen</a>
            </div>
        {{ Form::close() }}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
@endsection