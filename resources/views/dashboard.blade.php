@extends('layouts.app')


@section('style')
    {!! Html::style('css/jquery.mCustomScrollbar.min.css') !!}
    <style>

        @media only screen and (max-width: 800px) {

            /* Force table to not be like tables anymore */
            #no-more-tables table,
            #no-more-tables thead,
            #no-more-tables tbody,
            #no-more-tables th,
            #no-more-tables td,
            #no-more-tables tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables tr { border: 1px solid #ccc; }

            #no-more-tables td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align:left;
            }

            #no-more-tables td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align:left;
                font-weight: bold;
            }

            /*
            Label the data
            */
            #no-more-tables td:before { content: attr(data-title); }
        }


    </style>
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
                    <div id="no-more-tables">
                    <table class="table table-striped table-hover table-bordered table-responsive" >
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
                                <td data-title="Aktion">{{$ticketlog->action_name}}</td>
                                <td data-title="Ticketänder.">{{$ticketlog->change}}</td>
                                <td data-title="Spieler">{{$ticketlog->name == null ? "&nbsp;" : $ticketlog->name}}</td>
                                <td data-title="Kommentar">{{$ticketlog->comment == null ? "&nbsp;" : $ticketlog->comment}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
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
