@extends('layouts.daisy-drawer')

@section('content')
    @livewire('payroll.payslip-preview')
@endsection

@section('drawer-content')
    @livewire('payroll.employee-selection')
@endsection

@section('nav-list-items')
    <li><a>Navbar Item 1</a></li>
    <li><a>Navbar Item 2</a></li>
@endsection

@section('scripts')
@endsection
