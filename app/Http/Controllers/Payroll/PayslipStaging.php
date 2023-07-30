<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Payroll\EmployeeProvider;
use Illuminate\Http\Request;

class PayslipStaging extends Controller
{
    public function __construct(
        private EmployeeProvider $employeeProvider
    ) {
    }

    public function index()
    {
        return view('payroll.payslip.staging', [
            'employee_preview_list' => $this->employeeProvider->getPreview()
        ]);
    }
}
