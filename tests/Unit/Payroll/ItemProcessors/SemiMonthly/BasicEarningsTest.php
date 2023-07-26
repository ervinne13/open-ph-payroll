<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Policy;
use App\Models\Employee;
use App\Payroll\Subject;
use App\Models\PayPeriod;

class BasicEarningsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->processor = $this->app->make('App\Payroll\ItemProcessors\SemiMonthly\BasicEarnings');
    }
   
    /** 
     * @test 
     */
    public function it_gives_old_employees_half_their_monthly_rate(): void
    {
        $subject = $this->mock(Subject::class, function ($mock) {
            $mock->shouldReceive('getMonthlyRate')->andReturn(40000);

            $period = new PayPeriod();
            $period->date_from = Carbon::createFromDate(2018, 1, 1);          
            $mock->shouldReceive('getPeriod')->andReturn($period);

            $employee = new Employee();
            $employee->employment_started_at = Carbon::createFromDate(2000, 1, 1);
            $mock->shouldReceive('getEmployee')->andReturn($employee);
        });
        $payroll_item = $this->processor->generatePayrollItem($subject);
        $this->assertEquals(20000, $payroll_item->amount);
    }

    /** 
     * Note that we are not using Payroll Hero's formula from https://support.payrollhero.com/knowledge-base/middle-of-the-cut-off-computation-breakdown/
     * Instead, we count the number of days of that payroll period that the employee
     * must be present.
     * 
     * @test      
     */
    public function it_gives_new_employees_equivalent_daily_rate(): void
    {
        $subject = $this->mock(Subject::class, function ($mock) {
            $mock->shouldReceive('getMonthlyRate')->andReturn(14093.83);
            
            $period = new PayPeriod();
            $period->date_from = Carbon::parse("2018-07-26");
            $period->date_to = Carbon::parse("2018-08-10");
            $mock->shouldReceive('getPeriod')->andReturn($period);

            $employee = new Employee();
            $employee->employment_started_at = Carbon::parse("2018-08-01");
            $mock->shouldReceive('getEmployee')->andReturn($employee);
        });

        // Aug 1 - 10 had 8 working days, 
        $payroll_item = $this->processor->generatePayrollItem($subject);
        $this->assertEquals("4,404.32", number_format($payroll_item->amount, 2));
    }    
}
