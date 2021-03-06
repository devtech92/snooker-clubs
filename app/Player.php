<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    protected $fillable = ['player_name', 'contact', 'club_id'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static function payments()
    {
        return static::selectRaw('players.*, sum(transactions.amount) as payments')
            ->leftJoin('transactions', 'players.id', '=', 'transactions.player_id')
            ->groupBy('players.id');
//                ->groupBy('player_name')
//                ->groupBy('contact');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function related_games()
    {
        return $this->belongsToMany(Game::class, 'game_player');
    }

    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Game::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sumBills()
    {
        return $this->hasManyThrough(Bill::class, Game::class)
            ->selectRaw('sum(paid) as total_paid, SUM(bill) - sum(discount) - SUM(paid) AS total_balance, player_id')
            ->groupBy('player_id');
    }

    public function getSumBillsAttribute()
    {
        if (!array_key_exists('sumBills', $this->relations)) $this->load('sumBills');

        return $relation = $this->getRelation('sumBills');

        return ($relation) ? $relation->total_bills : 0;
    }


}
