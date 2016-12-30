<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Modpack extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modpacks';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}