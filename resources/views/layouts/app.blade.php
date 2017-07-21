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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="POST" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                                {{ csrf_field() }}
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="exampleInputEmail2">Username</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Username" required>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif

                                                    <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember"> keep me logged-in
                                                    </label>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="bottom text-center">
                                            New here ? <a href="#"><b>Join Us</b></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Passwort ändern</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/logout') }}">Abmelden</a></li>
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
                <li class="{{$currentTreeView == "dashboard" ? "active" : "" }} treeview">
                    <a href="#">
                        <i class="fa fa-home"></i> <span>Startseite</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{$currentMenuView == "home" ? 'class=active' : ""}}>
                            <a href="{{url('')}}"><i class="fa fa-circle-o"></i> Home</a></li>
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
            <b>Version</b> 0.1
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
@yield('script')

</body>
</html>
