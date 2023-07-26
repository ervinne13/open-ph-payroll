<?php

namespace App\Payroll;

use App\Models\Employee;
use App\Models\PayPeriod;

/**
 * We introduce the Payroll Subject as a means for us to pre-compute commonly used data and keep these data immutable
 */
class Subject
{
    public function __construct(
        private Employee $employee,
        private PayPeriod $period,
    ) { }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function getPeriod(): PayPeriod
    {
        return $this->period;
    }

    public function getMonthlyRate(): float
    {
        // TODO: This should come from policies instead,        
        return $this->employee->monthly_rate;
    }
}