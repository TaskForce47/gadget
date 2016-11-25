<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server_Config extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'server_config';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}