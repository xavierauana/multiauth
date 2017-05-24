<?php
/**
 * Author: Xavier Au
 * Date: 24/5/2017
 * Time: 1:34 PM
 */

namespace Anacreation\MultiAuth\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'remember_token'];

    protected $table = 'administrators';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
