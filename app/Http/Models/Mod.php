<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mods';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}