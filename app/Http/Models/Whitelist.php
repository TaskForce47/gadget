<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'whitelists';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function players()
    {
        return $this->belongsToMany('App\Http\Models\Player');
    }

    public function comments()
    {
        return $this->hasMany('App\Http\Models\Comment');
    }
}