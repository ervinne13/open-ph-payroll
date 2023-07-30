<?php

namespace App\Http\Livewire\Payroll;

use App\Payroll\EmployeeProvider;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class EmployeeSelection extends Component
{
    private EmployeeProvider $employee_provider;
    public string $search_term = '';

    /**
     * Create a new component instance.
     */
    public function boot(
        EmployeeProvider $employee_provider
    ) {
        $this->employee_provider = $employee_provider;
    }

    public function setSelectedEmployee(string $id): void
    {
        $this->emit('PayslipPreview.employeeIdChanged', $id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $employees = $this->employee_provider->getPreview();
        return view('livewire.payroll.employee-selection', ['employees' => $employees]);
    }
}
