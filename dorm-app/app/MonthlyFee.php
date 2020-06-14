<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MonthlyFee extends Model
{
    protected $table = "monthly_fees";

    // Black list of columns which this model shouldn't alter
    protected $guarded = [];

    protected $appends = [
        'closing_name'
    ];

    public function getClosingNameAttribute()
    {
        // Prepend 0 when the month has only 1 digit
        $month = (intval($this->month) > 9) ? strval($this->month) : "0" . strval($this->month);
        return "{$this->year}年{$month}月分";
    }
}
