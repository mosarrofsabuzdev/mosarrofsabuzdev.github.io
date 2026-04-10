<?php
namespace App\Livewire;
use App\Models\Deal;
use Livewire\Component;
class DealsIndex extends Component { public function render(){ return view('livewire.deals-index',['deals'=>Deal::latest()->limit(30)->get()]); } }
