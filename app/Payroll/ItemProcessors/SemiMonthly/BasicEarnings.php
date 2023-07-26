<?php

namespace App\Payroll\ItemProcessors\SemiMonthly;

use App\Payroll\Subject;
use App\Models\EmployeePayrollItem;
use App\Payroll\ItemProcessors\PayrollItemGenerator;

class BasicEarnings implements PayrollItemGenerator
{
    public function generatePayrollItem(Subject $subject): EmployeePayrollItem
    {
        if ($this->isSubjectNewHire($subject)) {
            return $this->generateForNewHires($subject);
        }

        $pay = new EmployeePayrollItem();
        $pay->amount = $subject->getMonthlyRate() / 2;
        return $pay;
    }

    /**
     * Maybe promote this to subject later? Double check, if we only need the check here
     * then good, otherwise, this belongs to the subject.
     */
    private function isSubjectNewHire(Subject $subject): bool
    {
        $employment_started_at = $subject->getEmployee()->employment_started_at;
        $cutoff_starts_at = $subject->getPeriod()->date_from;

        return $cutoff_starts_at->lt($employment_started_at);
    }

    /**
     * Payroll Hero's computation is nice as we don't need to consider holidays and weekends.
     * Based on current PH policies, holidays are paid anyway, and it seems like partial pay
     * for Mon-Fri and Mon-Sat employees are the same.
     * 
     * https://support.payrollhero.com/knowledge-base/middle-of-the-cut-off-computation-breakdown/
     */
    private function generateForNewHires(Subject $subject): EmployeePayrollItem
    {
        $employee = $subject->getEmployee();
        $rate = $subject->getMonthlyRate() / 2;
        
        $period = $subject->getPeriod();
        $days_in_period = $period->date_from->diffInDays($period->date_to) + 1;
        $hire_date_days = $employee->employment_started_at->diffInDays($period->date_to) + 1;

        // TODO: Study diffInDaysFiltered later.

        $pay = new EmployeePayrollItem();
        $pay->amount = ($rate / $days_in_period) * $hire_date_days;
        return $pay;
    }
}