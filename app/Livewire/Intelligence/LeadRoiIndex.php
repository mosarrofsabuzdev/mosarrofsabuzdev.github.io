<?php
namespace App\Livewire\Intelligence;
use App\Models\Lead;
use Livewire\Component;
class LeadRoiIndex extends Component { public function render(){ return view('livewire.intelligence.lead-roi-index',['sources'=>Lead::query()->selectRaw('source, count(*) as total, sum(deal_size) as revenue')->groupBy('source')->get()]); } }
