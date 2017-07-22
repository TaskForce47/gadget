<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TaskForce 47 Gadget</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

<body class="hold-transition skin-red sidebar-mini layout-boxed">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>TF</b>47</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>TF47</b> Gadget</span>
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
                            <ul id="login-dp" class="dropdown-menu">
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
                                                <button class="btn btn-primary btn-block">Anmleden</button>
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
                                            {{Form::open(['route'=>'register', 'method' => 'post', 'class' => 'form-horizontal'])}}
                                            <div class="box-body">
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Passwort ändern</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Abmelden
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
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
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <div style="display:inline-block; color:beige;">
                        <i class="fa fa-cogs fa-5x"></i>
                        Placeholder Logo
                    </div>
                </div>
            </div>
            <!-- /.search form -->
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
                        <i class="fa fa-gamepad"></i> <span>Missions</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "ticketlog" ? 'class=active' : ""}}>
                            <a href="{{url('missions/ticketlog/1')}}"><i class="fa fa-circle-o"></i> Ticketlog</a></li>
                    </ul>
                </li>
                <li class="{{$currentTreeView == "playerManagement" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Arma Spieler Verwaltung</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "playerManager" ? 'class=active' : ""}}>
                            <a href="{{url('players')}}"><i class="fa fa-circle-o"></i> Spieler Verwaltung</a></li>
                        <li {{$currentMenuView == "comments" ? 'class=active' : ""}}>
                            <a href="{{url('comments')}}"><i class="fa fa-circle-o"></i> Kommentare</a></li>
                        <li {{$currentMenuView == "teamManager" ? 'class=active' : ""}}>
                            <a href="{{url('teams')}}"><i class="fa fa-circle-o"></i> Team Verwaltung</a></li>
                        <li {{$currentMenuView == "whitelistManager" ? 'class=active' : ""}}>
                            <a href="{{url('whitelists')}}"><i class="fa fa-circle-o"></i> Whitelist Verwaltung</a></li>
                        <li {{$currentMenuView == "xmlGenerator" ? 'class=active' : ""}}>
                            <a href="{{url('xml/generate')}}"><i class="fa fa-circle-o"></i> XML generieren</a></li>
                    </ul>
                </li>
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
        $("#registerForm").hide();
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
    });
    $('#switchToRegButton').click(function(e) {
        e.stopPropagation();
    });
    $('#switchToLogButton').click(function(e) {
        e.stopPropagation();
    });
</script>
@yield('script')

</body>
</html>
