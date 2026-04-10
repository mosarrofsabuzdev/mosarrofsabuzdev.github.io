<?php
namespace App\Livewire;
use App\Models\Invoice;
use Livewire\Component;
class InvoicesIndex extends Component { public function render(){ return view('livewire.invoices-index',['invoices'=>Invoice::latest()->paginate(12)]);} }
