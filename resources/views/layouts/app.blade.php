<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TaskForce 47 Gadget</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{url('gadget.ico')}}" type="image/x-icon">
    <!-- Bootstrap 3.3.6 -->
    {!! Html::Style('bootstrap/css/bootstrap.min.css') !!}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Theme style -->
    {!! Html::Style('dist/css/AdminLTE.min.css') !!}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::Style('dist/css/skins/skin-red.min.css') !!}
    {!! Html::Style('css/fancynav.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {!! Html::style('plugins/iCheck/all.css') !!}

    @yield('style')

</head>
@php
    $currentUser = \Illuminate\Support\Facades\Auth::user();
@endphp
<body class="hold-transition skin-red sidebar-mini layout-boxed">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="fa fa-cogs"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><i class="fa fa-cogs"></i> <b>TF47</b> Gadget</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    @if($errors->has('name') || $errors->has('password'))
                        <li class="dropdown open">
                    @else
                        <li class="dropdown">
                    @endif
                        @if (Auth::guest())
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                @if($errors->has('name') || $errors->has('password'))
                                    aria-expanded="true">
                                @else
                                    aria-expanded="false">
                                @endif
                                <b>Login</b> <span class="caret"></span>
                            </a>
                            <ul id="login-dp" class="dropdown-menu" style="background-color: #ffffff; color: #000000">
                                <li class="user-body">
                                    <div class="row" id="loginForm">
                                        <div class="col-md-12">
                                            {{Form::open(['route'=>'login', 'method' => 'post'])}}
                                            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                                                {{Form::label('name', 'Benutzername')}}
                                                {{Form::text('name', '', array('class' => 'form-control',
                                                    'placeholder' => 'Benutzername', 'required' => 'required'))}}
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                                {{Form::label('password', 'Passwort')}}
                                                {{Form::password('password', array('class' => 'form-control',
                                                    'placeholder' => 'Passwort', 'required' => 'required'))}}
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('remember', 'Eingeloggt bleiben')}}
                                                {{Form::checkbox('remember')}}
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block">Anmelden</button>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        <div class="bottom text-center">
                                            <div id="switchToRegButton" class="btn btn-primary btn-block">Registrierung</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-body">
                                    <div class="row" id="registerForm">
                                        <div class="col-md-12">
                                            {{Form::open(['route'=>'register', 'method' => 'post'])}}
                                            <div class="alert alert-dismissible alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                Registriere dich nur, wenn ein <strong>Admin</strong>
                                                dich dazu <strong>aufgefordert</strong> hat.
                                            </div>
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                {{Form::label('name', 'Benutzername')}}
                                                {{Form::text('name', old('name'), array('class' => 'form-control', 'placeholder' =>
                                                    'Benutzername', 'required' => 'required', 'autofocus' => 'autofocus'))}}
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                {{Form::label('password', 'Passwort')}}
                                                {{Form::password('password', array('class' => 'form-control', 'placeholder' =>
                                                    'Passwort', 'required' => 'required'))}}
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password_confirmation', 'Passwort bestätigen')}}
                                                {{Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' =>
                                                    'Passwort bestätigen', 'required' => 'required'))}}
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block">Registrieren</button>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        <div class="bottom text-center">
                                            <div id="switchToLogButton" class="btn btn-primary btn-block">Anmeldung</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               @if($errors->has('name') || $errors->has('password'))
                               aria-expanded="true">
                                @else
                                    aria-expanded="false">
                                @endif
                                <b>{{Auth::user()->name}}</b> <span class="caret"></span>
                            </a>
                            <ul id="login-dp" class="dropdown-menu" style="background-color: #ffffff; color: #000000">
                                <li class="user-body" id="changePwForm">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{Form::open(['route'=>'changePassword.form', 'method' => 'post'])}}
                                            <div class="form-group {{ $errors->has('wrongPassword') ? 'has-error' : '' }}">
                                                {{Form::label('passwordOld', 'Altes Passwort')}}
                                                {{Form::password('passwordOld', array('class' => 'form-control', 'placeholder' =>
                                                    'Altes Passwort', 'required' => 'required', 'autofocus' => 'autofocus'))}}
                                                @if ($errors->has('wrongPassword'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('wrongPassword') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                {{Form::label('password', 'Passwort')}}
                                                {{Form::password('password', array('class' => 'form-control', 'placeholder' =>
                                                    'Passwort', 'required' => 'required'))}}
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('password_confirmation', 'Passwort bestätigen')}}
                                                {{Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' =>
                                                    'Passwort bestätigen', 'required' => 'required'))}}
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block">Passwort ändern</button>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        <div class="bottom text-center">
                                            <div class="btn btn-primary btn-block"
                                                 onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                Abmelden
                                            </div>
                                            {{Form::open(['route'=>'logout', 'method' => 'post', 'style' => 'display: none', 'id' => 'logout-form'])}}
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </li>
                                <li class="user-body" id="showChangePwBox">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="showChangePw" class="btn btn-primary btn-block">Passwort ändern</div>
                                            <div class="form-group"></div>
                                        </div>
                                        <div class="bottom text-center">
                                            <div class="btn btn-primary btn-block"
                                                 onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                Abmelden
                                            </div>
                                            {{Form::open(['route'=>'logout', 'method' => 'post', 'style' => 'display: none', 'id' => 'logout-form'])}}
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">HAUPTNAVIGATION</li>
                <li class="{{$currentTreeView == "home" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-home"></i> <span>Startseite</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "dashboard" ? 'class=active' : ""}}>
                            <a href="{{url('')}}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    </ul>
                </li>
                <li class="{{$currentTreeView == "mission" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-gamepad"></i> <span>Missionen</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($missionsMenu as $missionMenu)
                            @if($missionMenu->active)
                            <li {{$currentMenuView == "ticketlog_".$missionMenu->mission_id ? 'class=active' : ""}}>
                                <a href="{{url('missions/ticketlog', [$missionMenu->mission_id])}}">
                                    <i class="fa fa-circle-o"></i> {{$missionMenu->name}}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        @can('ticketLogManager')
                        <li {{$currentMenuView == "missionManager" ? 'class=active' : ""}}>
                            <a href="{{url('missions')}}"><i class="fa fa-circle-o"></i> Missionen Verwaltung</a></li>
                        @endcan
                    </ul>
                </li>
                @if($currentUser != null && ($currentUser->can('playerManager') || $currentUser->can('commentManager') || $currentUser->can('teamManager') ||
                        $currentUser->can('whitelistManager') || $currentUser->can('xmlManager')))
                <li class="{{$currentTreeView == "playerManagement" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Arma Spieler Verwaltung</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('playerManager')
                        <li {{$currentMenuView == "playerManager" ? 'class=active' : ""}}>
                            <a href="{{url('players')}}"><i class="fa fa-circle-o"></i> Spieler Verwaltung</a></li>
                        @endcan
                        @can('commentManager')
                        <li {{$currentMenuView == "comments" ? 'class=active' : ""}}>
                            <a href="{{url('comments')}}"><i class="fa fa-circle-o"></i> Kommentare</a></li>
                        @endcan
                        @can('teamManager')
                        <li {{$currentMenuView == "teamManager" ? 'class=active' : ""}}>
                            <a href="{{url('teams')}}"><i class="fa fa-circle-o"></i> Team Verwaltung</a></li>
                        @endcan
                        @can('whitelistManager')
                        <li {{$currentMenuView == "whitelistManager" ? 'class=active' : ""}}>
                            <a href="{{url('whitelists')}}"><i class="fa fa-circle-o"></i> Whitelist Verwaltung</a></li>
                        @endcan
                        @can('xmlManager')
                        <li {{$currentMenuView == "xmlGenerator" ? 'class=active' : ""}}>
                            <a href="{{url('xml/generate')}}"><i class="fa fa-circle-o"></i> XML generieren</a></li>
                        @endcan
                    </ul>
                </li>
                @endif
                @can('admin')
                <li  class="{{$currentTreeView == "servercontrol" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-server"></i> <span>Server Control</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "servermanager" ? 'class=active' : ""}}>
                            <a href="{{ url('servermanager') }}"><i class="fa fa-circle-o"></i> Server Manager</a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('admin')
                <li  class="{{$currentTreeView == "admin" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-wrench"></i> <span>Admin Bereich</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "userManager" ? 'class=active' : ""}}>
                            <a href="{{ url('users') }}"><i class="fa fa-circle-o"></i> Benutzer Verwaltung</a>
                        </li>
                        <li {{$currentMenuView == "groupManager" ? 'class=active' : ""}}>
                            <a href="{{ url('groups') }}"><i class="fa fa-circle-o"></i> Gruppen Verwaltung</a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2017 <a href="https://task-force47.de/">TaskForce47</a>.</strong> All rights
        reserved.
    </footer>

</div>
<!-- ./wrapper -->


@yield('modals')

    <!-- jQuery 2.2.3 -->
    {!! Html::Script('plugins/jQuery/jquery-2.2.3.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    {!! Html::Script('bootstrap/js/bootstrap.min.js') !!}
    <!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
    <!-- AdminLTE App -->
    {!! Html::Script('dist/js/app.min.js') !!}
    <!-- SlimScroll -->
    {!! Html::Script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
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
</script>

<script>
    $(document).ready(function(){

        @if(Auth::guest())
            @if(($errors->has('password') && ($errors->first('password') == "Die password Bestätigung stimmt nicht überein."
                || ($errors->first('password') == "Das password muss mindestens 6 Zeichen haben.")) || $errors->has('name')
                && ($errors->first('name') == "Der name wird bereits verwendet.")))
            $("#loginForm").hide();
            @else
            $("#registerForm").hide();
            @endif

            $("#switchToRegButton").click( function()
                {
                   $("#loginForm").hide(1000);
                   $("#registerForm").show(1000);
                }
            );
            $("#switchToLogButton").click( function()
                {
                   $("#registerForm").hide(1000);
                   $("#loginForm").show(1000);
                }
            );
        @else
        @if(($errors->has('password') && ($errors->first('password') == "Die password Bestätigung stimmt nicht überein."
            || ($errors->first('password') == "Das password muss mindestens 6 Zeichen haben.")) || $errors->has('wrongPassword')))
            $("#changePwForm").show();
            $("#showChangePwBox").hide();
        @else
            $('#changePwForm').hide();
        @endif

            $('#showChangePw').click(function(e) {
                $('#changePwForm').show(1000);
                $('#showChangePwBox').hide(1000);
            });
        @endif
    });
    $('#switchToRegButton').click(function(e) {
        e.stopPropagation();
    });
    $('#switchToLogButton').click(function(e) {
        e.stopPropagation();
    });
    $('#showChangePw').click(function(e) {
        e.stopPropagation();
    });
</script>
@yield('script')

</body>
</html>
