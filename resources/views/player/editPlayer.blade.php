@extends('layouts.app')

@section('style')
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
        <li><a href="{{url('url')}}">Player Management</a></li>
        <li><a href="{{url('players')}}">Player Manager</a></li>
        <li class="active">Edit Player</li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Player</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editPlayer.form', 'method' => 'post'])}}
        {{Form::hidden('playerDatabaseId', ($player->id == null ? 0 : $player->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('playerId', 'Arma 3 Player ID')}}
                    {{Form::text('playerId', $player->player_id, array('class' => 'form-control', 'placeholder' =>
                        'Player ID', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('name', 'Player Name')}}
                    {{Form::text('name', $player->name, array('class' => 'form-control', 'placeholder' =>
                        'Player Name', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('team', 'Teams')}}
                    @if (!empty($selectTeams))
                        {{Form::select('team', $selectTeams, $player->team == null ? 0 : $player->team->id,
                            array('class' => 'form-control', 'placeholder' => 'Wähle ein Team'))}}
                    @else
                        {{Form::select('team', [], null,
                            array('disabled', 'class' => 'form-control', 'placeholder' => 'Wähle ein Team'))}}
                    @endif

                </div>
                <div class="form-group">
                    {{Form::label('remark', 'Remark')}}
                    {{Form::text('remark', $player->remark, array('class' => 'form-control', 'placeholder' =>
                        'Remark'))}}
                </div>
                <div class="form-group">
                    {{Form::label('email', 'E-Mail')}}
                    {{Form::email('email', $player->email, array('class' => 'form-control', 'placeholder' =>
                        'E-Mail'))}}
                </div>
                <div class="form-group">
                    {{Form::label('icq', 'ICQ')}}
                    {{Form::text('icq', $player->icq, array('class' => 'form-control', 'placeholder' =>
                        'ICQ'))}}
                </div>
                <div class="form-group">
                    {{Form::label('steam', 'Steam')}}
                    {{Form::text('steam', $player->steam, array('class' => 'form-control', 'placeholder' =>
                        'Steam'))}}
                </div>
                <div class="form-group">
                    {{Form::label('skype', 'Skype')}}
                    {{Form::text('skype', $player->skype, array('class' => 'form-control', 'placeholder' =>
                        'Skype'))}}
                </div>
                <div class="form-group">
                    {{Form::label('country', 'Nationalität:')}}
                    <fieldset>
                        {{Form::radio('country', 'de', $player->country == 'de' ? true : false)}}
                        {{Form::label('de', 'Deutschland')}} <br>
                        {{Form::radio('country', 'at', $player->country == 'at' ? true : false)}}
                        {{Form::label('at', 'Österreich')}} <br>
                        {{Form::radio('country', 'ch', $player->country == 'ch' ? true : false)}}
                        {{Form::label('at', 'Schweiz')}} <br>
                    </fieldset>
                </div>
                <div class="form-group">
                    {{Form::label('whitelist', 'Whitelisten')}} <br>
                    @forelse ($whitelists as $whitelist)
                        {{Form::hidden('whitelist_' . $whitelist->id, -1)}}
                        {{Form::checkbox('whitelist_' . $whitelist->id, $whitelist->id,
                            $player->whitelists->contains($whitelist))}}
                        {{Form::label('whitelist_' . $whitelist->id, $whitelist->name)}}
                         <br>
                    @empty
                        Keine Whitelist vorhanden<br>
                    @endforelse
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-default pull-right" href="{{url('players')}}">Cancel</a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
    <!-- DataTables -->
    <!--
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    -->
    {!! Html::Script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::Script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    <!-- SlimScroll -->
    <!--<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
    {!! Html::Script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
@endsection