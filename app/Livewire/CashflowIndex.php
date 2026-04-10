<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Invoice;
use Livewire\Component;

class CashflowIndex extends Component
{
    public function render()
    {
        return view('livewire.cashflow-index', ['income' => (float) Invoice::whereIn('status', ['sent', 'paid'])->sum('total'), 'outflow' => (float) Bill::where('status', 'pending')->sum('amount')]);
    }
}
