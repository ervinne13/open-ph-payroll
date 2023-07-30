<?php

namespace App\Http\Livewire\Payroll;

use App\Payroll\EmployeeProvider;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class PayslipPreview extends Component
{
    protected $listeners = ['PayslipPreview.employeeIdChanged' => 'setEmployeeId'];

    private EmployeeProvider $employee_provider;
    public ?array $employee = null;

    /**
     * Create a new component instance.
     */
    public function boot(
        EmployeeProvider $employee_provider
    ) {
        $this->employee_provider = $employee_provider;
    }

    public function setEmployeeId(string $id)
    {
        $employees = $this->employee_provider->getPreview();
        $this->employee = Arr::first($employees, function ($e) use ($id) {
            return $e['id'] == $id;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('livewire.payroll.payslip-preview', ['employee' => $this->employee]);
    }
}
