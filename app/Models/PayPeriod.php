<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPeriod extends Model
{
    use HasFactory;

    public function __toString() {
        return "[{$this->date_from} - {$this->date_to}]";
    }
}
