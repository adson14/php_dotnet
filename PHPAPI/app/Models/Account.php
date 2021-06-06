<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['account_id','user_id','name','account_number'];
    protected $table = 'accounts';

    protected $primaryKey = 'account_id';

    protected  $dates = [
        'created_at',
        'updated_at'
    ];

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

    public function incoming(){
        return $this->hasMany(Incoming::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }

}
