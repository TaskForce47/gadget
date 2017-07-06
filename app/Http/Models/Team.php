<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function players()
    {
        return $this->hasMany('App\Http\Models\Player', 'team_id', 'id');
    }
}