@extends('layouts.app')


@section('style')
    {!! Html::style('css/jquery.mCustomScrollbar.min.css') !!}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Startseite</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Startseite</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
        <section class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-area-chart"></i> Whitelist Statistiken</div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($whitelistCount as $count)
                            <li class="list-group-item">
                                <span class="badge">{{$count->count}}</span>
                                <img src="images/whitelist/{{$count->id}}.png"
                                     alt="{{$count->name}}" height="16px" width="16px"/>   {{$count->name}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </section>
        <!-- /.Left col -->
        <section class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-users"></i> Team Statistiken</div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($teamCount as $team)
                            <li class="list-group-item">
                                <span class="badge">{{$team->count}}</span>
                                {{$team->title}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
            </div>
        <div class="row">
        <!-- right col -->
        <section class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-ticket"></i> Letzter Ticketlog</div>
                <div class="panel-body table-responsive mCustomScrollbar" style="max-height:300px; overflow:hidden;"
                     data-mcs-theme="inset-2-dark">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Aktion</th>
                            <th>Ticketänderung</th>
                            <th>Spieler</th>
                            <th>Kommentar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lastTicketlogs as $ticketlog)
                            <tr style="background-color: {{$ticketlog->color}}">
                                <td>{{$ticketlog->action_name}}</td>
                                <td>{{$ticketlog->change}}</td>
                                <td>{{$ticketlog->name}}</td>
                                <td>{{$ticketlog->comment}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

            <section class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Panel heading</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">14</span>
                                Cras justo odio
                            </li>
                            <li class="list-group-item">
                                <span class="badge">2</span>
                                Dapibus ac facilisis in
                            </li>
                            <li class="list-group-item">
                                <span class="badge">1</span>
                                Morbi leo risus
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            @can('admin')
                <p>test2</p>
            @endcan
        <!-- right col -->
        </div>
    </div>
    <!-- /.row (main row) -->
    </div>
</section>
<!-- /.content -->

@endsection

@section('script')
    {!! Html::Script('js/jquery.mCustomScrollbar.min.js') !!}

@endsection
