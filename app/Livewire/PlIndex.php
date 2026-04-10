<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Expense;
use App\Models\Invoice;
use Livewire\Component;

class PlIndex extends Component
{
    public function render()
    {
        $revenue = (float) Invoice::where('status', 'paid')->sum('total');
        $expenses = (float) Bill::where('status', 'paid')->sum('amount') + (float) Expense::sum('amount');

        return view('livewire.pl-index', compact('revenue', 'expenses'));
    }
}
