<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = true;

    protected $fillable = ['game_table_id', 'game_type_id', 'player_id', 'player_ids', 'completed', 'no_of_players', 'user_id',
        'bill', 'discount', 'started_at', 'ended_at'];

    protected $casts = [
        'completed' => 'boolean',
        'player_ids' => 'array',
    ];

//    protected $events = [
//        'created' => Events\GameCreated::class,
//        'updated' => Events\GameUpdated::class,
//    ];


    public function table()
    {
        return $this->belongsTo(GameTable::class, 'game_table_id');
    }


    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Bill::class);
    }

    public function game_type()
    {
        return $this->belongsTo(GameType::class, 'game_type_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'game_player');
    }







    public function scopeActive($query)
    {
        $query->where('ended_at', '=', null);
    }

    public function scopeCompleted($query)
    {
        $query->where('ended_at', '!=', null);
    }


    public function getStartedAtAttribute($date)
    {
        if (!is_null($date)) {
            return Carbon::parse($date);
        }
    }

    public function getEndedAtAttribute($date)
    {
        if (!is_null($date)) {
            return Carbon::parse($date);
//            return Carbon::createFromFormat('Y-m-d H:i:s', $date);
//          return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i A');
            // return Carbon::parse($date);

        }
    }


    public function setStartedAtAttribute($date)
    {
        if (is_string($date))
            $this->attributes['started_at'] = Carbon::parse($date);
    }

    public function setEndedAtAttribute($date)
    {
        if (is_string($date))
            $this->attributes['ended_at'] = Carbon::parse($date);
    }

    public function getCompletedAttribute($completed)
    {
        return (bool)$completed;
    }

    public function setCompletedAttribute($completed)
    {
        $this->attributes['completed'] = (bool)$completed;
    }

}
