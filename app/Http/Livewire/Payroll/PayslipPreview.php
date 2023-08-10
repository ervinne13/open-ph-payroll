<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Employee;
use App\Models\PayPeriod;
use App\Models\PayrollItem;
use App\Payroll\EmployeeProvider;
use App\Payroll\ItemProcessors\SemiMonthly\BasicEarnings;
use App\Payroll\Subject;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class PayslipPreview extends Component
{
    protected $listeners = ['PayslipPreview.employeeIdChanged' => 'setEmployeeId'];

    private BasicEarnings $processor;
    private EmployeeProvider $employee_provider;
    public ?Employee $employee = null;
    /**
     * @var PayrollItem[]
     */
    public array $payroll_items = [];
    /**
     * Create a new component instance.
     */
    public function boot(
        EmployeeProvider $employee_provider,
        BasicEarnings $processor
    ) {
        $this->employee_provider = $employee_provider;
        $this->processor = $processor;
    }

    public function setEmployeeId(string $id)
    {
        $employees = $this->employee_provider->getPreview();
        $this->employee = new Employee(Arr::first($employees, function ($e) use ($id) {
            return $e['id'] == $id;
        }));

        $this->recalculatePayrollItems();
    }

    private function recalculatePayrollItems()
    {
        $this->employee->monthly_rate = 40000;
        $this->employee->employment_started_at = Carbon::parse("2001-01-01");
        $subject = new Subject($this->employee, PayPeriod::fromDateStrings("2018-01-11", "2018-01-25"));
        $this->payroll_items = [
            $this->processor->generatePayrollItem($subject)
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('livewire.payroll.payslip-preview', [
            'employee' => $this->employee,
            'payroll_items' => $this->payroll_items
        ]);
    }
}
