<?php

namespace App;

use App\Models\Account;
use App\Models\Card;
use App\Models\Category;
use App\Models\Expenditure;
use App\Models\Incoming;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements  JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email', 'password',
    ];


    protected $primaryKey  = 'user_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function cards(){
        return $this->hasMany(Card::class);
    }

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function incomings(){
        return $this->hasMany(Incoming::class);
    }

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

}
