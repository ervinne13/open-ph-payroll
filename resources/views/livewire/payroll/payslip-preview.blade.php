<div>
    @if ($employee)
        <span>
            {{ $employee['display_name'] }}
        </span>
        <div>
            {{ json_encode($payroll_items) }}
        </div>
    @endif
</div>
