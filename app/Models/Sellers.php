<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sellers extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name','username','email', 'password','active','province','city','brgy','street_address','contact_num'
    ];

    protected $table = 'sellers';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->password;
    }
}
