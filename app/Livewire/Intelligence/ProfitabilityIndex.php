<?php
namespace App\Livewire\Intelligence;
use App\Models\Client;
use Livewire\Component;
class ProfitabilityIndex extends Component { public function render(){ $clients=Client::with('invoices')->get(); return view('livewire.intelligence.profitability-index',compact('clients')); } }
