<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id','name','limit','type'];
    protected $table = 'cards';

    protected $primaryKey = 'card_id';

    protected  $dates = [
        'created_at',
        'updated_at'
    ];

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
