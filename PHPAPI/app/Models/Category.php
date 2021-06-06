<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

/**
 * Class Category
 * @package App\Models
 * @property  string $name
 * @property  string $user_id
 * @property  string $type
 */
class Category extends Model  implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = ['user_id','name','type','color'];
    protected $table = 'categories';

    protected  $dates = [
      'created_at',
      'updated_at'
    ];

    protected $primaryKey = 'category_id';

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

    public function incomings(){
        return $this->hasMany(Incoming::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
