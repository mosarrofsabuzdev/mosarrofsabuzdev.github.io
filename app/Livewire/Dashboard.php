<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $pipelineValue = Deal::whereNotIn('stage', ['won', 'lost'])->sum('value');
        $mrr = Client::where('status', 'active')->sum('mrr');
        $unpaidInvoicesCount = Invoice::whereIn('status', ['sent', 'overdue'])->count();
        $unpaidInvoicesTotal = Invoice::whereIn('status', ['sent', 'overdue'])->sum('total');
        $cashBalance = Payment::whereMonth('date', now()->month)->sum('amount') - Bill::where('status', 'paid')->whereMonth('updated_at', now()->month)->sum('amount');
        $billsDue = Bill::where('status', 'pending')->whereBetween('due_date', [now(), now()->addDays(7)])->count();
        $monthlyProfit = Invoice::where('status', 'paid')->whereMonth('issue_date', now()->month)->sum('total') - Bill::where('status', 'paid')->whereMonth('updated_at', now()->month)->sum('amount');

        return view('livewire.dashboard', compact(
            'pipelineValue', 'mrr', 'unpaidInvoicesCount', 'unpaidInvoicesTotal', 'cashBalance', 'billsDue', 'monthlyProfit'
        ));
    }
}
