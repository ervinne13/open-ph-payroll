<?php 

namespace App\Payroll\ItemProcessors;

use App\Payroll\Subject;
use App\Models\EmployeePayrollItem;

interface PayrollItemGenerator
{
    function generatePayrollItem(Subject $subject): EmployeePayrollItem;
}