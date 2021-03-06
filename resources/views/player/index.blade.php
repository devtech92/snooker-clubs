@extends('layout.master')

@section('content')
    <div>

        <h2>Players List</h2>

        <div class="row">
            <div class="col-md-9">
                <a href="{{ route('showGames', ['club_id'=> session('club_id')]) }}"
                   class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Game Hall
                </a>

                <a href="{{ route('showPlayer', ['id'=> null]) }}"
                   class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> New Client /
                    Player
                </a>

            </div>

            {{--<div class="col-md-3">--}}
            {{--<div class="input-group">--}}
            {{--<span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>--}}
            {{--<input type="text" class="form-control" ng-model="query" autofocus placeholder="Type to search">--}}
            {{--</div>--}}

            {{--</div>--}}

        </div>


        <table class="table table-bordered table-hover" id="playerTable">
            <thead>
            <tr class="default">
                <th>Player Name</th>
                <th>Contact No.</th>
                <th>Payments</th>
                <th>Deleted At</th>
                <th></th>
            </tr>
            </thead>
            {{--@foreach($players as $player)--}}

            {{--<tr class={{ ($player->transactions->sum('amount') < 0 ) ? 'danger': '' }}>--}}
            {{--<td>--}}
            {{--<div>{{ $player->player_name}}</div>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--{{ $player->contact }}--}}
            {{--</td>--}}
            {{--<td>{{ $player->transactions->sum('amount') }}</td>--}}

            {{--<td>--}}
            {{--<a href="{{ route('showPlayer', ['id'=> $player->id]) }}"--}}
            {{--class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> Open--}}
            {{--</a>--}}
            {{--</td>--}}

            {{--</tr>--}}

            {{--@endforeach--}}


        </table>

    </div>
@endsection

@section('script')
    <script>

        $('#playerTable').DataTable({
            processing: true,
            serverSide: true,
            {{--ajax: '{!! route('datatables.data', ['club_id' => ]) !!}',--}}
            ajax: '/api/players/' + global.clubId,
            columns: [
//                {data: 'id', name: 'id'},
                {data: 'player_name', name: 'player_name'},
                {data: 'contact', name: 'contact'},
                {data: 'payments', name: 'payments'},
                {data: 'deleted_at', name: 'deleted_at'},
                {
                    name: 'actions',
                    data: null,
                    sortable: false,
                    searchable: false,
                    render: function (data) {
                        var actions = '';
                        actions += '<a href="{{route('showPlayer', ['id' => ':id'])}}" class="btn btn-default">Edit</a>';
                        {{--actions += '<a href="{{ route('destroyPlayer/', ':id') }}">Delete</a>';--}}
                            return actions.replace(/:id/g, data.id);
                    }
                }
//                {data: 'action', name: 'action'},
            ],
            order: [[1, 'asc']]
        });


    </script>
@endsection



{{--<tr ng-repeat="item in vm.players |  filter:query | orderBy: ['player_name']  "--}}
{{--ng-class="{danger: (vm.getTransactionSum(item.transactions) < 0)}">--}}

{{--<td>@{{ item.player_name }}</td>--}}
{{--<td>@{{ item.contact }}</td>--}}
{{--<td>@{{ vm.getTransactionSum(item.transactions)}}</td>--}}

{{--<td>--}}
{{--<a href="{{ route('showPlayerTransaction', ['id'=>  null ]) }}/@{{ item.id }}"--}}
{{--class="btn btn-default"><i class="fa fa-arrow-right"></i>--}}
{{--</a>--}}

{{--|--}}
{{--<a href="{{route('showPlayer', ['id' => null ])}}/@{{ item.id }}" class="btn btn-default btn-sm">--}}
{{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}
{{--</a>--}}

{{--<a ng-if="! (item.deleted_at || vm.getTransactionSum(item.transactions) < 0)"--}}
{{--ng-click="vm.destroyPlayer(item.id)" class="btn btn-danger btn-sm">--}}
{{--<i class="fa fa-trash" aria-hidden="true"></i></a>--}}

{{--<a ng-if="item.deleted_at" ng-click="vm.restorePlayer(item.id)" class="btn btn-info btn-sm">--}}
{{--<i class="fa fa-recycle" aria-hidden="true"></i></a>--}}

{{--</td>--}}

{{--</tr>--}}