<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Order;
class User extends \TCG\Voyager\Models\User{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'user_id');
    }

    public function shipping(){
      return $this->hasOne(Shipping::class, 'user_id');
    }

    public function billing(){
      return $this->hasOne(Billing::class, 'user_id');
    }
}