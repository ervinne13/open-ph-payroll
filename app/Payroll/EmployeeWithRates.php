<?php

namespace App\Payroll;

use App\Models\Employee;

class EmployeeRates
{
    public function __construct(
        private $number,
        private $monthlyRate,
        private $dailyRate
    )
    {
        // 
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getMonthly(): float
    {
        return $this->monthlyRate;
    }

    public function getDaily(): float
    {
        return $this->dailyRate;
    }
}