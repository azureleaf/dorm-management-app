<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MonthlyFee extends Model
{
    protected $table = "monthly_fees";

    protected $appends = [
        'closing_name'
    ];

    public function getClosingNameAttribute()
    {
        $year = Carbon::parse($this->closed_at)->year;
        $month = Carbon::parse($this->closed_at)->month;
        $month = (intval($month) > 9) ? strval($month) : "0" . strval($month);
        return "{$year}年{$month}月分決算";
    }
}
