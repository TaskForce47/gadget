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
        <li><a href="{{url('playerarea')}}">Player Bereich</a></li>
        <li><a href="{{url('players')}}">Players</a></li>
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
        {{Form::hidden('playerId', ($player->id == null ? 0 : $player->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$player->id}}">
                    <label for="playerId">Player ID</label>
                    <input type="text" class="form-control" name="playerId" placeholder="Arma 3 Player ID" value="{{$player->name}}" required>
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$player->player_id}}" required>
                    <label>Team :
                        <select name="team" class="form-control">
                            <option @if($player->team == null)selected @endif ></option>
                            @foreach($teams as $team)
                                <option @if($player->team == $team)selected
                                        @endif
                                >{{$team->name}}</option>
                            @endforeach
                        </select>
                    </label> <br>
                    <label for="remark">Remark</label>
                    <input type="text" class="form-control" name="remark" placeholder="Remark" value="{{$player->remark}}">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" name="email" placeholder="N/A" value="{{$player->email}}">
                    <label for="icq">ICQ</label>
                    <input type="text" class="form-control" name="icq" placeholder="N/A" value="{{$player->icq}}">
                    <label for="steam">Steam</label>
                    <input type="text" class="form-control" name="steam" placeholder="N/A" value="{{$player->steam}}">
                    <label for="skype">Skype</label>
                    <input type="text" class="form-control" name="skype" placeholder="N/A" value="{{$player->skype}}">
                    <label>Country :
                        <fieldset>
                            <input type="radio" name="country" value="de" checked>
                            <label for="de"> Deutschland</label> <br>
                            <input type="radio" id="at" name="country" value="at">
                            <label for="at"> Österreich</label> <br>
                            <input type="radio" id="ch" name="country" value="ch">
                            <label for="ch"> Schweiz</label> <br>
                            <input type="radio" id="us" name="country" value="us">
                            <label for="us"> Vereinigte Staaten von Amerika</label> <br>
                        </fieldset>
                    </label>
                    <br>
                    <br>
                    <label>Whitelists:</label>
                    @foreach($whitelists as $whitelist)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="{{$whitelist->name}}"
                                       @if($player->whitelists->contains($whitelist))checked
                                        @endif
                                >{{$whitelist->name}}
                            </label>
                        </div>
                    @endforeach

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