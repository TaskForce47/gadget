@extends('layouts.app')

@section('style')
    {!! Html::style('plugins/iCheck/all.css') !!}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$player->name}}
        <small>Kommentare</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
        <li><i class="fa fa-user"></i> Arma Spieler Verwaltung</li>
        <li><a href="{{url('players')}}"> Spieler Verwaltung</a></li>
        <li><a href="{{url('comments')}}"> Kommentare</a></li>
        <li><a href="{{url('players', [$player->id, 'comments'])}}"> {{$player->name}} - Kommentare</a></li>
        @if($comment->id == null)
            <li class="active"> Kommentar hinzufügen</li>
        @else
            <li class="active"> Kommentar bearbeiten</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($comment->id == null)
                <h3 class="box-title">Kommentar hinzufügen</h3>
            @else
                <h3 class="box-title">Kommentar bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'saveComment.form', 'method' => 'post'])}}
        {{Form::hidden('playerDatabaseId', ($player->id))}}
        {{Form::hidden('commentId', ($comment->id == null ? 0 : $comment->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('whitelist', 'Whitelists')}}
                    {{Form::select('whitelist', $allWhitelists, $comment->id == null ? 0 : $comment->whitelist_id,
                        array('class' => 'form-control'))}}
                </div>
                <div class="form-group">
                    {{Form::label('comment', 'Kommentar')}}
                    {{Form::textarea('comment', $comment->comment, array('class' => 'form-control', 'placeholder' =>
                        'Kommentar', 'rows' => 4, 'cols' => 50))}}
                </div>
                <div class="form-group">
                    {{Form::hidden('warning', 0)}}
                    {{Form::checkbox('warning', 1, $comment->warning)}} &nbsp;
                    {{Form::label('warning', 'Verwarnung')}}
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('players', [$player->id,'comments'])}}">Abbrechen</a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
    {!! Html::Script('plugins/iCheck/icheck.min.js') !!}
    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection