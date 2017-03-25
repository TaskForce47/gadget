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
                <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
    {!! Form::open(['route'=>'addserver.form', 'method' => 'post']) !!}
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
            {{Form::label('kickDuplicates', 'Kick duplicates')}}
            {{Form::checkbox('kickDuplicates', null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('verifySignatures', 'Verify Signatures')}}
            {{Form::checkbox('verifySignatures', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('headlessClients', 'Headless Client IPs')}}
            {{Form::text('headlessClients', '', array('class' => 'form-control', 'placeholder' => '127.0.0.1,127.0.0.2',
                'required' => 'required'))}}
        </div>
        <div class="form-group">
            {{Form::label('voteMissionPlayers', 'Vote Mission Players')}}
            {{Form::number('voteMissionPlayers', '', array('class' => 'form-control', 'placeholder' => 1,
                'min' => 0))}}
        </div>
        <div class="form-group">
            {{Form::label('voteThreshHold', 'Vote Mission Players (%)')}}
            {{Form::number('voteThreshHold', '', array('class' => 'form-control', 'placeholder' => 0,
                'min' => 0, 'max' => 1, 'step' => 0.01))}}
        </div>
        <div class="form-group">
            {{Form::label('disableVon', 'Disable VoN')}}
            {{Form::checkbox('disableVon', '', array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('vonQuality', 'VoN Codec Quality')}}
            {{Form::number('vonQuality', '', array('class' => 'form-control', 'placeholder' => 10,
                'min' => 0, 'max' => 64))}}
        </div>
            <label for="persistent">Persistent Server</label>
            <input type="checkbox" name="persistent">
            <br>
            <label for="battleye">Enable BattleEye</label>
            <input type="checkbox" name="battleye">
            <br>
            <label for="maxping">Max Ping</label>
            <input type="number" class="form-control" name="maxping" placeholder="100" min="0">
            <label for="maxdesync">Max Desync</label>
            <input type="number" class="form-control" name="maxdesync" placeholder="100" min="0">
            <label for="maxpacketloss">Max Packetloss (%)</label>
            <input type="number" class="form-control" name="maxpacketloss" placeholder="0" min="0" max="1" step="0.01">
            <label for="disconnecttimeout">Disconnect Timeout</label>
            <input type="number" class="form-control" name="disconnecttimeout" placeholder="90" min="0">
            <label for="kickslowclients">Kick clients on slow network</label>
            <input type="checkbox" name="kickslowclients" value="''">
            <br>
            <label for="doubleidcode">On double id detected code</label>
            <input type="text" class="form-control" name="doubleidcode" placeholder="command">
            <label for="userconnectcode">On user connected code</label>
            <input type="text" class="form-control" name="userconnectcode" placeholder="command">
            <label for="userdisconnectcode">On user disconnected code</label>
            <input type="text" class="form-control" name="userdisconnectcode" placeholder="command">
            <label for="hackeddatacode">On hacked data code</label>
            <input type="text" class="form-control" name="hackeddatacode" placeholder="command">
            <label for="diffdatacode">On different data code</label>
            <input type="text" class="form-control" name="diffdatacode" placeholder="command">
            <label for="unsigneddatacode">On unsigned data code</label>
            <input type="text" class="form-control" name="unsigneddatacode" placeholder="command">
            <label for="regularcheckcode">Regular check doe</label>
            <input type="text" class="form-control" name="regularcheckcode" placeholder="command">
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
    <!-- FastClick -->
    <!--<script src="../../plugins/fastclick/fastclick.js"></script>-->
    {!! Html::Script('plugins/fastclick/fastclick.js') !!}
    <!-- page script -->
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
        $('#delgroupmodal').on('show.bs.modal', function (e) {

            var roleid = $(e.relatedTarget).data('roleid');
            var rolename = $(e.relatedTarget).data('rolename');
            console.log(rolename);
            $(e.currentTarget).find('input[name="roleid"]').val(roleid);

            var textIns = 'Are you sure you want to delete the group ';
            var textIns2 = ' ?';
            rolename = (textIns.concat(rolename)).concat(textIns2);
            $('#delrolename').text(rolename)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection