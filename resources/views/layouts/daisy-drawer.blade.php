@extends('layouts.base')

@php
    if (!isset($title)) {
        $title = env('APP_NAME');
    }
@endphp

@section('body')
    <div class="drawer">
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300">
                <div class="flex-none lg:hidden">
                    <label for="mobile-drawer-toggle" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2">{{ $title }}</div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        @yield('nav-list-items')
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="drawer lg:drawer-open">
        <input id="mobile-drawer-toggle" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side">
            <label for="mobile-drawer-toggle" class="drawer-overlay"></label>
            <div class="menu p-4 w-80 h-full bg-base-200">
                @yield('drawer-content')
            </div>
        </div>
        <div class="drawer-content flex flex-col items-center justify-center">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
@endsection
