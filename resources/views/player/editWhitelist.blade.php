@extends('layouts.app')

@section('style')
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
        <li><a href="{{url('whitelists')}}"> Whitelist Verwaltung</a></li>
        @if($whitelist->id == null)
            <li class="active"> Whitelist hinzufügen</li>
        @else
            <li class="active"> Whitelist bearbeiten</li>
        @endif

    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($whitelist->id == null)
                <h3 class="box-title">Whitelist hinzufügen</h3>
            @else
                <h3 class="box-title">Whitelist bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(['route'=>'editwhitelist.form', 'method' => 'post']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Whitelist</label>
                    <input type="hidden" name="whitelistid" id="whitelistid" value="{{ $whitelist->id }}"/>
                    <input type="text" class="form-control" name="whitelistname" value="{{ $whitelist->name }}" required>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-default pull-right" href="{{url('whitelists')}}">Cancel</a>
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