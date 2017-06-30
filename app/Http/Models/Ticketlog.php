<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Ticketlog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticketlog';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function action()
    {
        return $this->belongsTo('App\Http\Models\Action');//, 'action_id');
    }

    public function player()
    {
        return $this->belongsTo('App\Http\Models\Player');
    }
}