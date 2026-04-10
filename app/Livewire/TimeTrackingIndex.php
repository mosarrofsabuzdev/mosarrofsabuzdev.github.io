<?php
namespace App\Livewire;
use App\Models\TimeEntry;
use Livewire\Component;
class TimeTrackingIndex extends Component { public function render(){ return view('livewire.time-tracking-index',['entries'=>TimeEntry::latest()->limit(30)->get(),'total'=>TimeEntry::sum('hours')]); } }
