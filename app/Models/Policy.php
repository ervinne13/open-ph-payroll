<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    const SCHED_MON_FRI = "MON-FRI";

    use HasFactory;
}
