<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'missions';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}