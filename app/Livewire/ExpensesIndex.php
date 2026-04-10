<?php
namespace App\Livewire;
use App\Models\Expense;
use Livewire\Component;
class ExpensesIndex extends Component { public function render(){ return view('livewire.expenses-index',['expenses'=>Expense::latest()->paginate(15)]);} }
