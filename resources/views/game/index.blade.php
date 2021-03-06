@extends('layout.master')

@section('content')

    <h1>Game Hall
        <small>({{$club->club_name}})</small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="">

                @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                    <a href="{{ route('showGameTable', ['club_id'=> $club->id, 'id' => -1] ) }}"
                       class="btn btn-default">
                        <i class="fa fa-plus" aria-hidden="true"></i> New Table
                    </a>
                @endif

                <a href="{{ route('showGame', ['id'=>null]) }}"
                   class="btn btn-primary"> <i class="fa fa-plus"></i> New Game
                </a>


                <div class="pull-right">

                    <a href="{{route('showTransactions')}}" class="btn btn-default">
                        <i class="fa fa-book" aria-hidden="true"></i> Payments Summery</a>

                    <a href="{{route('listGames', ['club_id', session('club_id')])}}" class="btn btn-info">
                        <i class="fa fa-list" aria-hidden="true"></i> All Games
                    </a>

                    <a href="{{route('showPlayers')}}" class="btn btn-default">
                        <i class="fa fa-list" aria-hidden="true"></i> Players
                    </a>

                    <!-- Trash Button-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><span
                                    class="glyphicon glyphicon-trash"></span>
                            Trash
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('showDestroyedGames')}}">Deleted Games</a></li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="row">

        <game-hall club-id="{{ session('club_id') }}">
            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </game-hall>


    </div>


@endsection



{{--<div class="col-md-6">--}}

{{--<div class="panel panel-{{($game->completed) ? 'default' : 'danger'}}">--}}
{{--<div class="panel-heading">Table No. <strong> {{ $game->table->table_no }} </strong>--}}
{{--</div>--}}
{{--<div class="panel-body">--}}
{{--<p>...</p>--}}
{{--</div>--}}
{{--<div class="panel-body">--}}
{{--<ul class="list-group">--}}
{{--<li class="list-group-item">No. of Players <span--}}
{{--class="label label-danger">{{ $game->no_of_players }}</span></li>--}}
{{--<li class="list-group-item">Started At <span--}}
{{--class="badge">{{ $game->started_at }}</span>--}}
{{--</li>--}}
{{--<li class="list-group-item">Ended At <span--}}
{{--class="badge">{{ $game->ended_at }}</span>--}}
{{--</li>--}}
{{--<li class="list-group-item">Player / Client<span--}}
{{--class="badge">{{ $game->player->player_name }}</span></li>--}}
{{--</ul>--}}


{{--<a href="{{ route('showGame', ['club_id'=> $club->id, 'id' => $game->id] ) }}"--}}
{{--class="btn btn-primary btn-block">--}}
{{--<i class="fa fa-edit" aria-hidden="true"></i> Open--}}
{{--</a>--}}
{{--<a href="{{ route('showBill',--}}
{{--['game_id'=> $game->id,--}}
{{--'club_id' => $club->id,--}}
{{--'id' =>  (!is_null($game->bill)) ? $game->bill->id : '', ] ) }}"--}}
{{--class="btn btn-danger btn-block"> Bill--}}
{{--<i class="fa fa-arrow-right" aria-hidden="true"></i>--}}
{{--</a>--}}

{{--</div>--}}

{{--</div> --}}{{--End Panel--}}
{{--</div>--}}


{{--@php($total_balance = 0)--}}
{{--@foreach($players as $player)--}}
{{--@if( $player->transactions->sum('amount') < 0 )--}}
{{--@php($total_balance = $total_balance + $player->transactions->sum('amount'))--}}

{{--<tr>--}}
{{--<td>{{ $player->player_name }}--}}
{{--<span class="label label-danger">{{ $player->transactions->sum('amount') }}</span>--}}
{{--</td>--}}
{{--<td>--}}
{{--@foreach($player->games as $game)--}}
{{--<div>{{$game->game_type->game_type}} - --}}
{{--{{$game->started_at}}</div>--}}
{{--@endforeach--}}
{{--</td>--}}
{{--<td>--}}
{{--<a href="{{ route('showPlayerTransaction', ['id'=> $player->id]) }}"--}}
{{--class="btn btn-default btn-sm"><i class="fa fa-arrow-right"></i>--}}
{{--</a>--}}
{{--</td>--}}
{{--</tr>--}}

{{--@endif--}}

{{--@endforeach--}}


{{--<div class="panel panel-danger">--}}
{{--<div class="panel-heading">Total Balance<strong> </strong></div>--}}

{{--<div class="panel-body">--}}

{{--@foreach($club->games as $game)--}}

{{--@if ( $game->transactions->sum('amount') <  ($game->bill - $game->discount) )--}}

{{--<div>--}}
{{--<strong>(Table:{{$game->table->table_no}})</strong>--}}
{{--At {{$game->started_at}}--}}
{{--</div>--}}
{{--<div>--}}
{{--Bill:<span--}}
{{--class="label label-default">{{ $game->bill - $game->discount }} </span>--}}
{{--Payment:<span--}}
{{--class="label label-danger">{{ ($game->transactions) ? $game->transactions->sum('amount') : '' }}</span>--}}
{{--</div>--}}

{{--@endif--}}
{{--@endforeach--}}
{{--</div>--}}

{{----}}


{{--<div class="panel-footer">--}}

{{--<h3>Total: <span class="label label-danger">{{ 12000 }}</span></h3>--}}

{{--</div>--}}


{{--</div> --}}{{--End Panel--}}


{{--<div class="panel panel-success">--}}
{{--<div class="panel-heading">Total Bills</div>--}}

{{--<table class="table table-hover table-condensed table-bordered">--}}
{{--<tr>--}}
{{--<th>Table</th>--}}
{{--<th>Today - Discount</th>--}}
{{--<th>This Month</th>--}}
{{--</tr>--}}

{{--@foreach($bills as $table => $bill)--}}
{{--<tr>--}}
{{--<td>{{$table}}</td>--}}

{{--<td>--}}
{{--<div>--}}
{{--{{ $bill['today']['bill'] }} ---}}
{{--<span class="label label-default">{{ $bill['today']['discount'] }}</span>--}}
{{--</div>--}}
{{--</td>--}}

{{--<td>--}}
{{--<div>--}}
{{--{{ $bill['thisMonth']['bill'] }} ---}}
{{--<span class="label label-default">{{ $bill['thisMonth']['discount'] }}</span>--}}
{{--</div>--}}
{{--</td>--}}

{{--</tr>--}}
{{--@endforeach--}}

{{--<tr>--}}
{{--<td><h3>Total</h3></td>--}}
{{--<td>--}}
{{--<h3><span class="label label-success">{{ $totals['today'] }}</span> ---}}
{{--<span class="label label-default">{{ $totals['discountToday'] }}</span>--}}
{{--</h3>--}}

{{--</td>--}}
{{--<td><h3>--}}
{{--<span class="label label-success">{{ $totals['thisMonth'] }}</span> ---}}
{{--<span class="label label-default">{{ $totals['discountThisMonth'] }}</span>--}}

{{--</h3></td>--}}
{{--</tr>--}}


{{--</table>--}}


{{--</div>--}}


{{--<div class="panel panel-primary">--}}
{{--<div class="panel-heading">Game Tables</div>--}}
{{--<div class="panel-body">--}}

{{--@foreach($club->tables as $table)--}}

{{--<div class="panel panel-{{--}}
{{--( $table->games->where('ended_at', null)->count('ended_at') == 0 ) ? 'default': 'primary'}}">--}}

{{--<div class="panel-heading">--}}
{{--{{ $table->table_no }}--}}
{{--<a href="{{route('showGameTable', ['id'=> $table->id])}}"--}}
{{--class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>--}}

{{--</div>--}}
{{--<div class="panel-body">--}}
{{--<table class="table table-bordered table-hover table-condensed">--}}
{{--<tr>--}}
{{--<th>Game</th>--}}
{{--<th>Started at</th>--}}
{{--<th>Bill</th>--}}
{{--<th>Player</th>--}}
{{--<th></th>--}}
{{--</tr>--}}
{{--@if (!is_null($table->games))--}}
{{--@foreach($table->games as $game)--}}
{{--@if( is_null($game->ended_at) )--}}
{{--<tr>--}}
{{--<td>{{ $game->type->game_type }}</td>--}}
{{--<td>{{ ($game->started_at)? $game->started_at->format('d-m-Y @ h:m a') : ''}}</td>--}}
{{--<td>{{ $game->bill - $game->discount }}</td>--}}
{{--<td>--}}
{{--@foreach($game->players as $player)--}}
{{--<li>{{ $player->player_name }}</li>--}}
{{--@endforeach--}}
{{--</td>--}}
{{--<td>--}}
{{--<a href="{{ route('showGame', ['table_id'=>$table->id, 'id'=>$game->id]) }}"--}}
{{--class="btn btn-default btn-sm">--}}
{{--<i class="fa fa-pencil"></i>--}}
{{--</a>--}}
{{--</td>--}}
{{--</tr>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--@endif--}}

{{--</table>--}}
{{--</div>--}}
{{--</div>--}}

{{--@endforeach--}}


{{--</div>--}}

{{--</div>--}}

<template id="commented">

    {{--<div class="col-md-6">--}}

    {{--<div class="panel panel-primary">--}}
    {{--<div class="panel-heading">Games</div>--}}

    {{--<table class="table table-bordered table-condensed">--}}
    {{--<tr>--}}
    {{--<th>Table</th>--}}
    {{--<th>Games</th>--}}

    {{--</tr>--}}
    {{--@foreach($club->tables as $table)--}}

    {{--@php($games_count = $table->games->count('ended_at') > 0)--}}

    {{--<tr>--}}
    {{--<td>--}}
    {{--<h3>--}}
    {{--<span class="label label-{{($games_count) ? 'success': 'default'}}">{{ $table->table_no }}</span>--}}
    {{--</h3>--}}
    {{--</td>--}}

    {{--<td>--}}
    {{--@if ($games_count)--}}

    {{--<table class="table table-condensed table-hover" style="margin-bottom: 1px;">--}}
    {{--<tr>--}}
    {{--<th>Game</th>--}}
    {{--<th>Started at</th>--}}
    {{--<th>Bill</th>--}}
    {{--<th>Player</th>--}}
    {{--<th></th>--}}
    {{--</tr>--}}
    {{--@foreach($table->games as $game)--}}
    {{--@if( is_null($game->ended_at) )--}}
    {{--<tr>--}}
    {{--<td>{{ $game->type->game_type }}</td>--}}
    {{--<td>{{ ($game->started_at)? $game->started_at->format('d-m-Y @ h:m a') : ''}}</td>--}}
    {{--<td>{{ $game->bill - $game->discount }}</td>--}}
    {{--<td>--}}
    {{--@foreach($game->players as $player)--}}
    {{--<li>{{ $player->player_name }}</li>--}}
    {{--@endforeach--}}
    {{--</td>--}}
    {{--<td>--}}
    {{--<a href="{{ route('showGame', ['table_id'=>$table->id, 'id'=>$game->id]) }}"--}}
    {{--class="btn btn-default btn-sm">--}}
    {{--<i class="fa fa-pencil"></i>--}}
    {{--</a>--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endif--}}
    {{--@endforeach--}}
    {{--</table>--}}
    {{--@endif--}}

    {{--</td>--}}
    {{--<td></td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</table>--}}

    {{--</div>--}}


    {{--</div>--}}

</template>