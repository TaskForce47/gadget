<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        //'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Http\Models\Role', 'user_has_roles');
    }

    /**
     * Find a user by its name.
     *
     * @param string $name
     *
     * @throws UserDoesNotExist
     *
     * @return Role
     */
    public static function findByName($name)
    {
        $user = static::where('name', $name)->first();

        if (!$user) {
            throw new UserDoesNotExist();
        }

        return $user;
    }
}
