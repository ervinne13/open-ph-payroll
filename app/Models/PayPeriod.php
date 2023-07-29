<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayPeriod extends Model
{
    use HasFactory;

    public static function fromDateStrings(string $date_from, string $date_to, string $pay_date = null): PayPeriod
    {
        if ($pay_date == null) {
            $pay_date = $date_to;
        }

        $period = new PayPeriod();
        $period->date_from = Carbon::parse($pay_date);
        $period->date_from = Carbon::parse($date_from);
        $period->date_to = Carbon::parse($date_to);

        return $period;
    }

    public function __toString()
    {
        return "[{$this->date_from} - {$this->date_to}]";
    }
}
