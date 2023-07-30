<?php

namespace App\Http\Livewire\Payroll;

use App\Payroll\EmployeeProvider;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class PayslipPreview extends Component
{
    private EmployeeProvider $employee_provider;
    public string $employee_id = '1';

    /**
     * Create a new component instance.
     */
    public function mount(
        EmployeeProvider $employee_provider
    ) {
        $this->employee_provider = $employee_provider;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $employee = null;
        if ($this->employee_id) {
            $employees = $this->employee_provider->getPreview();
            $employee = Arr::first($employees, function ($e) {
                return $e['id'] == $this->employee_id;
            });
        }

        return view('livewire.payroll.payslip-preview', ['employee' => $employee]);
    }
}
