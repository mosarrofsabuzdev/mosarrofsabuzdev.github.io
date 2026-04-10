<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'UPNEZ Agency OS') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="h-full bg-slate-50 text-slate-800" x-data="{ sidebarOpen: true, notificationsOpen: false }">
        <div class="hidden"><livewire:layout.navigation /></div>
        <div class="min-h-screen flex">
            <aside :class="sidebarOpen ? 'w-60' : 'w-16'" class="fixed inset-y-0 left-0 z-30 bg-[#0F172A] text-slate-200 border-r border-slate-700 transition-all duration-150">
                <div class="h-16 flex items-center justify-between px-4 border-b border-slate-700">
                    <div class="font-extrabold tracking-tight text-xl" x-show="sidebarOpen"><span class="text-[#2563EB]">UP</span><span class="text-white">NEZ</span></div>
                    <button class="text-slate-400 hover:text-white" @click="sidebarOpen = !sidebarOpen">☰</button>
                </div>
                <nav class="p-3 space-y-1 text-sm">
                    <x-sidebar-link href="{{ route('dashboard') }}" label="Dashboard" />
                    <x-sidebar-section label="CRM" :open="true" />
                    <x-sidebar-link href="{{ route('leads.index') }}" label="Leads" />
                    <x-sidebar-link href="{{ route('deals.index') }}" label="Deals" />
                    <x-sidebar-link href="{{ route('clients.index') }}" label="Clients" />
                    <x-sidebar-link href="{{ route('contacts.index') }}" label="Contacts" />
                    <x-sidebar-section label="Operations" :open="true" />
                    <x-sidebar-link href="{{ route('projects.index') }}" label="Projects" />
                    <x-sidebar-link href="{{ route('tasks.index') }}" label="Tasks" />
                    <x-sidebar-link href="{{ route('time-tracking.index') }}" label="Time Tracking" />
                    <x-sidebar-link href="{{ route('files.index') }}" label="Files" />
                    <x-sidebar-section label="Finance" :open="true" />
                    <x-sidebar-link href="{{ route('invoices.index') }}" label="Invoices" />
                    <x-sidebar-link href="{{ route('bills.index') }}" label="Bills" />
                    <x-sidebar-link href="{{ route('cashflow.index') }}" label="Cashflow" />
                    <x-sidebar-link href="{{ route('pl.index') }}" label="P&L" />
                    <x-sidebar-link href="{{ route('payments.index') }}" label="Payments" />
                    <x-sidebar-link href="{{ route('expenses.index') }}" label="Expenses" />
                    <x-sidebar-section label="Intelligence" :open="true" />
                    <x-sidebar-link href="{{ route('intelligence.kpi') }}" label="KPI" />
                    <x-sidebar-link href="{{ route('intelligence.profitability') }}" label="Profitability" />
                    <x-sidebar-link href="{{ route('intelligence.team') }}" label="Team" />
                    <x-sidebar-link href="{{ route('intelligence.lead-roi') }}" label="Lead ROI" />
                    @role('owner')
                        <x-sidebar-section label="Settings" :open="true" />
                        <x-sidebar-link href="{{ route('settings.company') }}" label="Company" />
                        <x-sidebar-link href="{{ route('settings.users') }}" label="Users" />
                        <x-sidebar-link href="{{ route('settings.email') }}" label="Email" />
                        <x-sidebar-link href="{{ route('settings.integrations') }}" label="Integrations" />
                    @endrole
                </nav>
            </aside>

            <div :class="sidebarOpen ? 'ml-60' : 'ml-16'" class="flex-1 transition-all duration-150">
                <header class="h-16 sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-slate-200 px-5 flex items-center justify-between">
                    <input type="search" placeholder="Search..." class="w-72 rounded-lg border-slate-200 text-sm focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <div class="flex items-center gap-4">
                        <button class="relative" @click="notificationsOpen = !notificationsOpen">
                            <span class="text-xl">🔔</span>
                            @if(auth()->user()?->appNotifications()->whereNull('read_at')->count())
                                <span class="absolute -top-1 -right-1 h-2.5 w-2.5 rounded-full bg-red-500 animate-pulse"></span>
                            @endif
                        </button>
                        <a href="{{ route('profile') }}" class="h-9 w-9 rounded-full bg-[#2563EB] text-white grid place-items-center font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</a>
                    </div>
                </header>

                <main class="p-6 max-w-[1400px] mx-auto">{{ $slot }}</main>
            </div>

            <div x-show="notificationsOpen" x-transition class="fixed inset-y-0 right-0 w-96 bg-white border-l border-slate-200 shadow-xl z-40">
                <livewire:notifications-panel />
            </div>
        </div>
        @livewireScripts
    </body>
</html>
