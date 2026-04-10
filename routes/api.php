<?php

use App\Models\Bill;
use App\Models\Deal;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;

Route::get('/charts/revenue-expenses', function () {
    $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

    $labels = $months->map(fn ($d) => $d->format('M Y'));
    $revenue = $months->map(fn ($d) => (float) Invoice::where('status', 'paid')->whereYear('issue_date', $d->year)->whereMonth('issue_date', $d->month)->sum('total'));
    $expenses = $months->map(fn ($d) => (float) Bill::where('status', 'paid')->whereYear('due_date', $d->year)->whereMonth('due_date', $d->month)->sum('amount'));

    return response()->json(compact('labels', 'revenue', 'expenses'));
});

Route::get('/charts/pipeline-funnel', function () {
    $stages = ['new', 'qualified', 'proposal', 'won', 'lost'];
    $counts = collect($stages)->mapWithKeys(fn ($stage) => [$stage => Deal::where('stage', $stage)->count()]);

    return response()->json($counts);
});
