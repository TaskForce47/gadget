<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function ticketlog()
    {
        return $this->belongsTo('App\Http\Models\Ticketlog');
    }

}