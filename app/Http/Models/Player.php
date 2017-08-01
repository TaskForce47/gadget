<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo('App\Http\Models\Team', 'team_id');
    }

    public function user()
    {
        return $this->hasOne('App\Http\Models\User', 'user_id');
    }

    public function whitelists()
    {
        return $this->belongsToMany('App\Http\Models\Whitelist');
    }

    public function comments()
    {
        return $this->hasMany('App\Http\Models\Comment', "player_id");
    }


    /**
     * Find a player by its name.
     *
     * @param string $name
     *
     * @throws PlayerDoesNotExist
     *
     * @return Player
     */
    public static function findByName($name)
    {
        $player = static::where('name', $name)->first();

        if (!$player) {
            throw new PlayerDoesNotExist();
        }

        return $player;
    }

    /**
     * Find a player by its name.
     *
     * @param string $name
     *
     * @throws PlayerDoesNotExist
     *
     * @return Player
     */
    public static function findByPlayerId($id)
    {
        $player = static::where('player_id', $id)->first();

        if (!$player) {
            return $player;
        }

        return $player;
    }
}