<?php
namespace App\Livewire;
use App\Models\Payment;
use Livewire\Component;
class PaymentsIndex extends Component { public function render(){ return view('livewire.payments-index',['payments'=>Payment::latest()->paginate(15)]);} }
