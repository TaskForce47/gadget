@extends('layouts.app')

@section('style')
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">-->
    {!! Html::Style('/plugins/datatables/dataTables.bootstrap.css') !!}
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
    {{ Form::open(['route'=>'addserver.form', 'method' => 'post']) }}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('gadgetName', 'Gadget Name')}}
            {{Form::text('gadgetName', '', array('class' => 'form-control', 'placeholder' => 'Gadget Name',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Server Password')}}
            {{Form::text('password', '', array('class' => 'form-control', 'placeholder' => 'Server Password'))}}
        </div>
        <div class="form-group">
            {{Form::label('adminPassword', 'Admin Password')}}
            {{Form::text('adminPassword', '', array('class' => 'form-control', 'placeholder' => 'Admin Password',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('motd', 'MotD')}}
            {{Form::textarea('motd', '', array('class' => 'form-control', 'placeholder' => 'MotD',
                'rows' => 4, 'cols' => 50))}}
        </div>
        <div class="form-group">
            {{Form::label('motdInterval', 'MotD Interval')}}
            {{Form::number('motdInterval', '', array('class' => 'form-control', 'placeholder' => 0,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxPlayers', 'Max Players')}}
            {{Form::number('maxPlayers', '', array('class' => 'form-control', 'placeholder' => 1,
                'min' => 1,  'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::hidden('kickDuplicates', 0)}}
            {{Form::label('kickDuplicates', 'Kick duplicates')}}
            {{Form::checkbox('kickDuplicates', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::hidden('verifySignatures', 0)}}
            {{Form::label('verifySignatures', 'Verify Signatures')}}
            {{Form::checkbox('verifySignatures', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('headlessClients', 'Headless Client IPs')}}
            {{Form::text('headlessClients', '', array('class' => 'form-control',
            'placeholder' => '127.0.0.1,127.0.0.2'))}}
        </div>
        <div class="form-group">
            {{Form::label('voteMissionPlayers', 'Vote Mission Players')}}
            {{Form::number('voteMissionPlayers', '', array('class' => 'form-control', 'placeholder' => 1,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('voteThreshold', 'Vote Mission Players (%)')}}
            {{Form::number('voteThreshold', '', array('class' => 'form-control', 'placeholder' => 0,
                'min' => 0, 'max' => 1, 'step' => 0.01))}}
        </div>
        <div class="form-group">
            {{Form::hidden('disableVon', 0)}}
            {{Form::label('disableVon', 'Disable VoN')}}
            {{Form::checkbox('disableVon', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('vonQuality', 'VoN Codec Quality')}}
            {{Form::number('vonQuality', '', array('class' => 'form-control', 'placeholder' => 10,
                'min' => 0, 'max' => 64))}}
        </div>
        <div class="form-group">
            {{Form::hidden('persistent', 0)}}
            {{Form::label('persistent', 'Persistent Server')}}
            {{Form::checkbox('persistent', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::hidden('battleye', 0)}}
            {{Form::label('battleye', 'Enable Battleye')}}
            {{Form::checkbox('battleye', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('maxPing', 'Max Ping')}}
            {{Form::number('maxPing', '', array('class' => 'form-control', 'placeholder' => 100,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxDesync', 'Max desync')}}
            {{Form::number('vonQuality', '', array('class' => 'form-control', 'placeholder' => 100,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('maxPacketloss', 'Max Packetloss (%)')}}
            {{Form::number('maxPacketloss', '', array('class' => 'form-control', 'placeholder' => 0,
                'min' => 0, 'max' => 1, 'step' => 0.01))}}
        </div>
        <div class="form-group">
            {{Form::label('disconnectTimeout', 'Disconnect Timeout')}}
            {{Form::number('disconnectTimeout', '', array('class' => 'form-control', 'placeholder' => 90,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::hidden('kickSlowClients', 0)}}
            {{Form::label('kickSlowClients', 'Kick clients on slow network')}}
            {{Form::checkbox('kickSlowClients', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('doubleIdCode', 'On double id detected code')}}
            {{Form::text('doubleIdCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('userConnectCode', 'On user connected code')}}
            {{Form::text('userConnectCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('userDisconnectCode', 'On user disconnected code')}}
            {{Form::text('userDisconnectCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('hackedDataCode', 'On hacked data code')}}
            {{Form::text('hackedDataCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('differentDataCode', 'On different data code')}}
            {{Form::text('differentDataCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('unsignedDataCode', 'On unsigned data code')}}
            {{Form::text('unsignedDataCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
        </div>
        <div class="form-group">
            {{Form::label('regularCheckCode', 'On regular check code')}}
            {{Form::text('regularCheckCode', '', array('class' => 'form-control', 'placeholder' => 'command'))}}
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
    <!-- TODO: Adjust for edit -->
    <script>
        $(function () {
            //$("#example1").DataTable();
            $('#usergrouptable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>

    <script>
        $( "button" ).click(function() {
            $( "p" ).slideToggle( "slow" );
        });
    </script>

    <script>
        $('#kickDuplicates').prop('checked', false);
        $('#verifySignatures').prop('checked', false);
        $('#disableVon').prop('checked', false);
        $('#persistent').prop('checked', false);
        $('#battleye').prop('checked', false);
        $('#kickSlowClients').prop('checked', false);
    </script>

@endsection