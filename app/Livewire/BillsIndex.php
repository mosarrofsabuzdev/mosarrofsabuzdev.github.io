<?php
namespace App\Livewire;
use App\Models\Bill;
use Livewire\Component;
class BillsIndex extends Component { public function render(){ return view('livewire.bills-index',['bills'=>Bill::latest()->paginate(12)]);} }
