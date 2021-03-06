<?php


Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', 'AuthController@login')->name('login');

    Route::post('/login', 'AuthController@postLogin')->name('login');


});

Route::group(['middleware' => 'manager'], function () {

    Route::post('/logout', 'AuthController@logout')->name('logout');

    Route::get('/', 'ClubController@index')->name('home');

    Route::get('gameType/index', 'GameTypeController@index')->name('showGameTypes');


    Route::get('game-table/show/{id?}', 'GameTableController@show')->name('showGameTable');
    Route::post('game-table/store', 'GameTableController@store')->name('storeGameTable');


    Route::get('{club_id}/games/index', 'GameController@index')->name('showGames');
    Route::get('{club_id}/games/list', 'GameController@games')->name('listGames');
    Route::get('game/show/{id?}', 'GameController@show')->name('showGame');
    Route::get('{club_id}/game/show/', 'GameController@create')->name('createGame');
    Route::post('game/store', 'GameController@store')->name('storeGame');
    Route::get('games/{club_id}', 'GameController@getGames')->name('getGames');

    Route::get('games/index/destroyed/', function () {
        return view('game.destroyed_index');
    })->name('showDestroyedGames');

    Route::get('games/destroyed/{club_id}', 'GameController@getGamesListWithTrash')->name('api.getDestroyedGames');


    Route::get('game/destroy/{id}', 'GameController@destroy')->name('destroyGame');

    Route::get('game/destroy/{id}', 'GameController@destroy')->name('destroyGame');

    Route::get('game/restore/{id}', 'GameController@restore')->name('restoreGame');


    Route::get('bills/index', 'BillController@index')->name('showBills');
    Route::get('{club_id}/game/{game_id}/bill/show/{id?}', 'BillController@show')->name('showBill');
    Route::post('bill/store', 'BillController@store')->name('storeBill');

    Route::get('transactions/index', 'TransactionController@index')->name('showTransactions');
    Route::post('transaction/store', 'TransactionController@store')->name('storeTransaction');
    Route::post('transaction/user/store', 'TransactionController@storeUserShare')->name('storeUserShare');


    Route::get('player/index', 'PlayerController@index')->name('showPlayers');
    Route::get('player/{id?}', 'PlayerController@show')->name('showPlayer');
    Route::post('player/store', 'PlayerController@store')->name('storePlayer');
    Route::post('player/destroy/{id}', 'PlayerController@destroy')->name('destroyPlayer');
    Route::get('player/transactions/{id}/{transaction_id?}', 'PlayerController@showPlayerTransaction')->name('showPlayerTransaction');

    Route::get('resetPassword', 'AuthController@resetPassword')->name('resetPassword');
    Route::post('storeResetPassword', 'AuthController@storeResetPassword')->name('storeResetPassword');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('club/show/{id?}', 'ClubController@show')->name('showClub');
        Route::post('club/store', 'ClubController@store')->name('storeClub');


        Route::get('gameType/show/{id?}', 'GameTypeController@show')->name('showGameType');
        Route::post('gameType/store', 'GameTypeController@store')->name('storeGameType');

        Route::get('/user/index', 'UserController@index')->name('showUsers');
        Route::get('/register', 'UserController@showRegistration')->name('showRegistration');
        Route::post('/register', 'UserController@storeUser')->name('storeUser');


    });
});


Route::get('/test', function () {


    $first = \App\Transaction::selectRaw('working_day, receive_date, sum(amount) as total_payment, sum(bill-ifNull(discount, 0)) as total_bill ')
        ->leftJoin('games', 'games.working_day', '=', 'transactions.receive_date')
        ->groupBy('working_day')
        ->groupBy('receive_date')
        ->get();

    return $second = \App\Transaction::selectRaw('working_day, receive_date, sum(amount) as total_payment, sum(bill-ifNull(discount, 0)) as total_bill ')
        ->rightJoin('games', 'games.working_day', '=', 'transactions.receive_date')
        ->groupBy('working_day')
        ->groupBy('receive_date')
        ->union($first)
        ->get();

    return \App\Club::with(['tables.games' => function ($query) {

        $query->withTotalPayments()
            ->having('total_bill', '>', 'total_payments')
            ->orWhere('ended_at', null);
    },
        'tables.games.type',

        'tables.games.players' => function ($query) {

            $query->withTrashed();

        }])->find(1);


    //return $g = Sentinel::getUser()->id;
//    return $g = \App\Game::with('bill')->get();
//    return $g = Sentinel::getRoleRepository()->get();

//    return \App\Club::with(['tables.games' => function ($query) {
//        $query->active();
//    }, 'players.transactions'])->find(1);
//
//    return $g = \App\GameTable::with('sumBills')->get();
//
//    return $g->filter(function ($value, $key) {
//        if (!is_null($value->bill_date))
//            return $value->bill_date->isToday();
//    })->sum('paid');
//
//    return $g->where('bill_date', \Carbon\Carbon::today())->sum('paid');
//
//    $g = \App\GameTable::with('bills')->get();
//
//    $g->first()->bills->sum('bill');
//
//    return $bill = $g->each(function ($item, $key) {
//
//        echo 'Table  ' . $item->table_no . '<br>';
//        echo 'Sum Bill  ' . $item->bills->sum('bill') . '<br>';
//        echo '<hr>';
//    });
//    return;
//
//    $clubs = \App\Club::with('tables.bills')->get();
//
//    $bill = $clubs->each(function ($item, $key) {
//
//        echo 'Game ' . $item->club_name . '<br>';
//        echo 'No. of Bill  ' . $item->tables->count('bill') . '<br>';
//        echo 'Sum Bill  ' . $b = $item->tables->each(function ($table, $key) {
//                    return $table->sum('bills.bill');
//                })
//                . '<br>';
//        echo 'Pending Bill  ' . $item->tables . '<br>';
//        echo '<hr>';
//    });

    //return $c;


    /*return \App\Game::with('table', 'player')
        ->whereHas('table', function ($query) {
            $query->where('club_id', 2);
        })->get();*/

});

