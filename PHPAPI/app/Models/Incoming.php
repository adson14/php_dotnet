<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Incoming
 * @package App\Models
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $date_incoming
 */
class Incoming extends Model
{
    protected $fillable = ['incoming_id','account_id','category_id','user_id','description','value','date_incoming','repeat'];
    protected $table = 'incomings';

    protected $primaryKey = 'incoming_id';

    protected  $dates = [
        'created_at',
        'updated_at',
        'date_incoming'
    ];

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function accounts(){
        return $this->belongsTo(Account::class);
    }

}
