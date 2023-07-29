<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Policy;
use App\Models\Employee;
use App\Payroll\Subject;
use App\Models\PayPeriod;
use App\Payroll\ItemProcessors\SemiMonthly\BasicEarnings;

class BasicEarningsTest extends TestCase
{
    private BasicEarnings $processor;

    public function setUp(): void
    {
        parent::setUp();
        $this->processor = $this->app->make(BasicEarnings::class);
    }

    /** 
     * @test 
     */
    public function it_gives_old_employees_half_their_monthly_rate(): void
    {
        /** @var Subject $subject */
        $subject = $this->mock(Subject::class, function ($mock) {
            $mock->shouldReceive('getMonthlyRate')->andReturn(40000);

            $period = PayPeriod::fromDateStrings("2018-01-11", "2018-01-25");
            $mock->shouldReceive('getPeriod')->andReturn($period);

            $employee = new Employee();
            $employee->employment_started_at = Carbon::parse("2001-01-01");
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
        /** @var Subject $subject */
        $subject = $this->mock(Subject::class, function ($mock) {
            $mock->shouldReceive('getMonthlyRate')->andReturn(14093.83);

            $period = PayPeriod::fromDateStrings("2018-07-26", "2018-08-10");
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
