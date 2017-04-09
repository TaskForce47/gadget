<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function player()
    {
        return $this->belongsTo('App\Http\Models\Player');
    }

    public function whitelist()
    {
        return $this->belongsTo('App\Http\Models\Whitelist');
    }
}