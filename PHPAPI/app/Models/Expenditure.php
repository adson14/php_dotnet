<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Expenditure extends Model
{
    protected $fillable = ['expenditure_id','account_id','category_id','user_id','card_id','description','value','date_expenditure','repeat'];
    protected $table = 'expenditures';

    protected $primaryKey = 'expenditure_id';

  
  
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

   // protected $dateFormat = 'Y-m-d H:i:sO';

   protected $dateFormat = 'Y-m-d H:i:s.uO';

    public function setDateExpenditureAttribute($value) {
        $this->attributes['date_expenditure'] = empty($value) ? null : Carbon::parse($value)->format('Y-m-d');
    }

    public function getDateExpenditureAttribute($value)
    {
        
        return Carbon::parse($value);
    }

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
