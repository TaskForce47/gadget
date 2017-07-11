@extends('layouts.app')

@section('style')
    {!! Html::style('plugins/iCheck/all.css') !!}
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
            <li><a href="#"><i class="fa fa-server"></i> Server</a></li>
            <li class="active">Server Manager</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Server Config</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
    {{Form::open(['route'=>'editServer.form', 'method' => 'post'])}}
    {{Form::hidden('serverId', ($serverConfig->id == null ? 0 : $serverConfig->id))}}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('gadgetName', 'Gadget Name')}}
            {{Form::text('gadgetName', $serverConfig->gadget_name, array('class' => 'form-control', 'placeholder' => 'Gadget Name',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $serverConfig->name, array('class' => 'form-control', 'placeholder' => 'Name',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Server Password')}}
            {{Form::text('password', $serverConfig->password, array('class' => 'form-control', 'placeholder' => 'Server Password'))}}
        </div>
        <div class="form-group">
            {{Form::label('adminPassword', 'Admin Password')}}
            {{Form::text('adminPassword', $serverConfig->admin_password, array('class' => 'form-control', 'placeholder' => 'Admin Password',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('motd', 'MotD')}}
            {{Form::textarea('motd', $serverConfig->motd, array('class' => 'form-control', 'placeholder' => 'MotD',
                'rows' => 4, 'cols' => 50))}}
        </div>
        <div class="form-group">
            {{Form::label('motdInterval', 'MotD Interval')}}
            {{Form::number('motdInterval', $serverConfig->motd_interval, array('class' => 'form-control',
                'placeholder' => 0, 'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxPlayers', 'Max Players')}}
            {{Form::number('maxPlayers', $serverConfig->max_players, array('class' => 'form-control',
                'placeholder' => 1, 'min' => 1,  'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::hidden('kickDuplicates', 0)}}
            {{Form::checkbox('kickDuplicates', 1, $serverConfig->kick_duplicates)}}
            {{Form::label('kickDuplicates', '&nbsp;Kick duplicates')}}
        </div>
        <div class="form-group">
            {{Form::hidden('verifySignatures', 0)}}
            {{Form::checkbox('verifySignatures', 1, $serverConfig->verify_signatures)}}
            {{Form::label('verifySignatures', '&nbsp;Verify Signatures')}}
        </div>
        <div class="form-group">
            {{Form::label('headlessClients', 'Headless Client IPs')}}
            {{Form::text('headlessClients', $serverConfig->headless_clients, array('class' => 'form-control',
            'placeholder' => '127.0.0.1,127.0.0.2'))}}
        </div>
        <div class="form-group">
            {{Form::label('voteMissionPlayers', 'Vote Mission Players')}}
            {{Form::number('voteMissionPlayers', $serverConfig->vote_mission_players,
            array('class' => 'form-control', 'placeholder' => 1,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('voteThreshold', 'Vote Mission Players (%)')}}
            {{Form::number('voteThreshold', $serverConfig->vote_threshold, array('class' => 'form-control', 'placeholder' => 0,
                'min' => 0, 'max' => 1, 'step' => 0.01))}}
        </div>
        <div class="form-group">
            {{Form::hidden('disableVon', 0)}}
            {{Form::checkbox('disableVon', 1, $serverConfig->disable_von)}}
            {{Form::label('disableVon', '&nbsp;Disable VoN')}}
        </div>
        <div class="form-group">
            {{Form::label('vonQuality', 'VoN Codec Quality')}}
            {{Form::number('vonQuality', $serverConfig->von_codec_quality, array('class' => 'form-control', 'placeholder' => 10,
                'min' => 0, 'max' => 64))}}
        </div>
        <div class="form-group">
            {{Form::hidden('persistent', 0)}}
            {{Form::checkbox('persistent', 1, $serverConfig->persistent)}}
            {{Form::label('persistent', '&nbsp;Persistent Server')}}
        </div>
        <div class="form-group">
            {{Form::hidden('battleye', 0)}}
            {{Form::checkbox('battleye', 1, $serverConfig->battle_eye)}}
            {{Form::label('battleye', '&nbsp;Enable Battleye')}}
        </div>
        <div class="form-group">
            {{Form::label('maxPing', 'Max Ping')}}
            {{Form::number('maxPing', $serverConfig->max_ping, array('class' => 'form-control', 'placeholder' => 100,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxDesync', 'Max desync')}}
            {{Form::number('vonQuality', $serverConfig->max_desync, array('class' => 'form-control', 'placeholder' => 100,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxPacketloss', 'Max Packetloss (%)')}}
            {{Form::number('maxPacketloss', $serverConfig->max_packetloss,
                array('class' => 'form-control', 'placeholder' => 0, 'min' => 0, 'max' => 1, 'step' => 0.01))}}
        </div>
        <div class="form-group">
            {{Form::label('disconnectTimeout', 'Disconnect Timeout')}}
            {{Form::number('disconnectTimeout', $serverConfig->disconnect_timeout,
                array('class' => 'form-control', 'placeholder' => 90, 'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::hidden('kickSlowClients', 0)}}
            {{Form::checkbox('kickSlowClients', 1,  $serverConfig->kick_clients_on_slow_network)}}
            {{Form::label('kickSlowClients', '&nbsp;Kick clients on slow network')}}
        </div>
        <div class="form-group">
            {{Form::label('doubleIdCode', 'On double id detected code')}}
            {{Form::text('doubleIdCode', $serverConfig->double_id_detected,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('userConnectCode', 'On user connected code')}}
            {{Form::text('userConnectCode', $serverConfig->on_user_connected,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('userDisconnectCode', 'On user disconnected code')}}
            {{Form::text('userDisconnectCode', $serverConfig->on_user_disconnected,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('hackedDataCode', 'On hacked data code')}}
            {{Form::text('hackedDataCode', $serverConfig->on_hacked_data,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('differentDataCode', 'On different data code')}}
            {{Form::text('differentDataCode', $serverConfig->on_different_data,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('unsignedDataCode', 'On unsigned data code')}}
            {{Form::text('unsignedDataCode', $serverConfig->on_unsigned_data,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('regularCheckCode', 'On regular check code')}}
            {{Form::text('regularCheckCode', $serverConfig->regular_check,
                array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="box-footer">
            {{Form::submit('Save', array('class' => 'btn btn-primary'))}}
            <a class="btn btn-default pull-right" href="{{url('servermanager')}}">Cancel</a>
        </div>
    </div>
    {{ Form::close() }}
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
    <!-- FastClick -->
    <!--<script src="../../plugins/fastclick/fastclick.js"></script>-->
    {!! Html::Script('plugins/fastclick/fastclick.js') !!}
    <!-- page script -->
    {!! Html::Script('plugins/iCheck/icheck.min.js') !!}



    <script>
        $(document).ready(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });
        });
        $('#kickDuplicates').iCheck('check');
    </script>

@endsection