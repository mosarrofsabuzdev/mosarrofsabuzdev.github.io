<?php

use App\Livewire\BillsIndex;
use App\Livewire\CashflowIndex;
use App\Livewire\ClientsIndex;
use App\Livewire\ContactsIndex;
use App\Livewire\Dashboard;
use App\Livewire\DealsIndex;
use App\Livewire\ExpensesIndex;
use App\Livewire\FilesIndex;
use App\Livewire\Intelligence\KpiIndex;
use App\Livewire\Intelligence\LeadRoiIndex;
use App\Livewire\Intelligence\ProfitabilityIndex;
use App\Livewire\Intelligence\TeamIndex;
use App\Livewire\InvoicesIndex;
use App\Livewire\LeadsIndex;
use App\Livewire\PaymentsIndex;
use App\Livewire\PlIndex;
use App\Livewire\ProjectsIndex;
use App\Livewire\Settings\CompanySettings;
use App\Livewire\Settings\EmailSettings;
use App\Livewire\Settings\IntegrationsSettings;
use App\Livewire\Settings\UserManagement;
use App\Livewire\TasksIndex;
use App\Livewire\TimeTrackingIndex;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/leads', LeadsIndex::class)->name('leads.index');
    Route::get('/deals', DealsIndex::class)->name('deals.index');
    Route::get('/clients', ClientsIndex::class)->name('clients.index');
    Route::get('/contacts', ContactsIndex::class)->name('contacts.index');

    Route::get('/projects', ProjectsIndex::class)->name('projects.index');
    Route::get('/tasks', TasksIndex::class)->name('tasks.index');
    Route::get('/time-tracking', TimeTrackingIndex::class)->name('time-tracking.index');
    Route::get('/files', FilesIndex::class)->name('files.index');

    Route::get('/invoices', InvoicesIndex::class)->name('invoices.index');
    Route::get('/invoices/{invoice}/pdf', function (\App\Models\Invoice $invoice) {
        return Pdf::loadView('pdf.invoice', ['invoice' => $invoice->load('client', 'project')])->download("{$invoice->invoice_number}.pdf");
    })->name('invoices.pdf');
    Route::get('/bills', BillsIndex::class)->name('bills.index');
    Route::get('/cashflow', CashflowIndex::class)->name('cashflow.index');
    Route::get('/pl', PlIndex::class)->name('pl.index');
    Route::get('/payments', PaymentsIndex::class)->name('payments.index');
    Route::get('/expenses', ExpensesIndex::class)->name('expenses.index');

    Route::get('/intelligence/kpi', KpiIndex::class)->name('intelligence.kpi');
    Route::get('/intelligence/profitability', ProfitabilityIndex::class)->name('intelligence.profitability');
    Route::get('/intelligence/team', TeamIndex::class)->name('intelligence.team');
    Route::get('/intelligence/lead-roi', LeadRoiIndex::class)->name('intelligence.lead-roi');

    Route::middleware('role:owner')->prefix('settings')->name('settings.')->group(function (): void {
        Route::get('/company', CompanySettings::class)->name('company');
        Route::get('/users', UserManagement::class)->name('users');
        Route::get('/email', EmailSettings::class)->name('email');
        Route::get('/integrations', IntegrationsSettings::class)->name('integrations');
    });

    Route::view('/profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
