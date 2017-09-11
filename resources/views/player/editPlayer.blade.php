@extends('layouts.app')

@section('style')
    {!! Html::style('css/flag-icon.min.css') !!}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Spieler Verwaltung
        <small>Arma Spieler Verwaltung</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-home"></i> Startseite</a></li>
        <li><i class="fa fa-user"></i> Arma Spieler Verwaltung </li>
        <li><a href="{{url('players')}}"> Spieler Verwaltung</a></li>
        @if($player->id == null)
            <li class="active"> Spieler hinzufügen</li>
        @else
            <li class="active"> Spieler bearbeiten</li>
        @endif
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            @if($player->id == null)
                <h3 class="box-title">Spieler hinzufügen</h3>
            @else
                <h3 class="box-title">Spieler bearbeiten</h3>
            @endif
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {{Form::open(['route'=>'editPlayer.form', 'method' => 'post'])}}
        {{Form::hidden('playerDatabaseId', ($player->id == null ? 0 : $player->id))}}
            <div class="box-body">
                @if($errorMsg != '')
                    <div class="alert alert-danger small" role="alert">{{ $errorMsg }}</div>
                @endif
                <div class="form-group">
                    {{Form::label('playerId', 'Arma 3 Player ID')}}
                    {{Form::text('playerId', $player->player_id, array('class' => 'form-control', 'placeholder' =>
                        'Player ID', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('beGuid', 'BattlEye GUID')}}
                    {{Form::text('beGuid', $player->be_guid, array('class' => 'form-control', 'placeholder' =>
                        'BattlEye GUID', 'disabled' => 'disabled'))}}
                </div>
                <div class="form-group">
                    {{Form::label('name', 'Player Name')}}
                    {{Form::text('name', $player->name, array('class' => 'form-control', 'placeholder' =>
                        'Player Name', 'required' => 'required'))}}
                </div>
                <div class="form-group">
                    {{Form::label('team', 'Teams')}}
                    @if (!empty($selectTeams))
                        {{Form::select('team', $selectTeams, $player->team == null ? 0 : $player->team->id,
                            array('class' => 'form-control', 'placeholder' => 'Wähle ein Team'))}}
                    @else
                        {{Form::select('team', [], null,
                            array('disabled', 'class' => 'form-control', 'placeholder' => 'Wähle ein Team'))}}
                    @endif

                </div>
                <div class="form-group">
                    {{Form::label('remark', 'Remark')}}
                    {{Form::text('remark', $player->remark, array('class' => 'form-control', 'placeholder' =>
                        'Remark'))}}
                </div>
                <div class="form-group">
                    {{Form::label('email', 'E-Mail')}}
                    {{Form::email('email', $player->email, array('class' => 'form-control', 'placeholder' =>
                        'E-Mail'))}}
                </div>
                <div class="form-group">
                    {{Form::label('icq', 'ICQ')}}
                    {{Form::text('icq', $player->icq, array('class' => 'form-control', 'placeholder' =>
                        'ICQ'))}}
                </div>
                <div class="form-group">
                    {{Form::label('steam', 'Steam')}}
                    {{Form::text('steam', $player->steam, array('class' => 'form-control', 'placeholder' =>
                        'Steam'))}}
                </div>
                <div class="form-group">
                    {{Form::label('skype', 'Skype')}}
                    {{Form::text('skype', $player->skype, array('class' => 'form-control', 'placeholder' =>
                        'Skype'))}}
                </div>
                <div class="form-group">
                    {{Form::label('country', 'Nationalität:')}}
                    <fieldset>
                        {{Form::radio('country', 'de', $player->country == 'de' || $player->country == null ? true : false)}}
                        {{Form::label('de', 'Deutschland')}} <span class="flag-icon flag-icon-de"></span> <br>
                        {{Form::radio('country', 'at', $player->country == 'at' ? true : false)}}
                        {{Form::label('at', 'Österreich')}} <span class="flag-icon flag-icon-at"></span> <br>
                        {{Form::radio('country', 'ch', $player->country == 'ch' ? true : false)}}
                        {{Form::label('at', 'Schweiz')}} <span class="flag-icon flag-icon-ch"></span> <br>
                        {{Form::radio('country', 'oc', $player->country == 'oc' ? true : false)}}
                        {{Form::label('oc', 'Anderes Land')}} <i class="fa fa-flag" aria-hidden="true"></i>
                    </fieldset>
                </div>
                <div class="form-group">
                    {{Form::label('whitelist', 'Whitelisten:')}} <br>
                    @forelse ($whitelists as $whitelist)
                        {{Form::hidden('whitelist_' . $whitelist->id, -1)}}
                        {{Form::checkbox('whitelist_' . $whitelist->id, $whitelist->id,
                            $player->whitelists->contains($whitelist),
                                \Illuminate\Support\Facades\Auth::user()->can('whitelist_'.$whitelist->id) ?
                                [] : array('disabled' => 'disabled'))}}
                        {{Form::label('whitelist_' . $whitelist->id, $whitelist->name)}}
                         <br>
                    @empty
                        Keine Whitelist vorhanden<br>
                    @endforelse
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Speichern</button>
                <a class="btn btn-default pull-right" href="{{url('players')}}">Abbrechen</a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
</section>
@endsection

@section('modals')

@endsection

@section('script')
@endsection