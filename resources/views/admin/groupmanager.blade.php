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
            <li><a href="#"><i class="fa fa-wrench"></i> Admin Bereich</a></li>
            <li class="active">Usergroupmanager</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usergroups</h3>
                <div class="pull-right">
                    <a class="btn btn-success" data-toggle="modal" data-target="#addgroupmodal" href="#">
                        <i class="fa fa-plus fa-lg"></i> Add Group</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usergrouptable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Permissions</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                @foreach($role->permissions as $perm)
                                    "{{ $perm->name }}"
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info" href="{{ url('groupmanager/edit', [$role->id]) }}">
                                        <i class="fa fa-pencil" title="Edit Group"></i>
                                    </a>
                                    <a class="btn btn-danger delete-group-class" data-toggle="modal"
                                       data-roleid="{{$role->id}}" data-rolename="{{$role->name}}" href="#delgroupmodal">
                                        <i class="fa fa-trash" title="Delete"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('modals')

<!-- Modal -->
<div id="addgroupmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    {!! Form::open(['route'=>'addgroup.form', 'method' => 'post']) !!}
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Groupname</h4>
            </div>
            <div class="modal-body">
                <label for="exampleInputEmail1">Groupname</label>
                <input type="text" class="form-control" name="groupname" placeholder="Groupname" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</div>

<!-- Modal -->
<div id="delgroupmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    {!! Form::open(['route'=>'delgroup.form', 'method' => 'post']) !!}
        <input type="hidden" name="roleid" id="roleid" value=""/>
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Groupname</h4>
            </div>
            <div class="modal-body">
                <div id="delrolename"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
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

            var textIns = 'Are you sure you want to delete the group "';
            var textIns2 = '" ?';
            rolename = (textIns.concat(rolename)).concat(textIns2);
            $('#delrolename').text(rolename)

            //obj.html(obj.html().replace(/\n/g,'<br/>'));
        });
    </script>

@endsection