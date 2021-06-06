<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expenditure
 * @package App\Models
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $date_expenditure
 */

class Expenditure extends Model
{
    protected $fillable = ['expenditure_id','account_id','category_id','user_id','card_id','description','value','date_expenditure','repeat'];
    protected $table = 'expenditures';

    protected $primaryKey = 'expenditure_id';

    protected  $dates = [
        'created_at',
        'updated_at',
        'date_expenditure'
    ];

    public function cards(){
        return $this->belongsTo(Card::class);
    }

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
