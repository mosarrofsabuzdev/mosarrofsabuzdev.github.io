<?php
namespace App\Livewire\Intelligence;
use App\Models\Client;
use App\Models\Project;
use App\Models\TimeEntry;
use Livewire\Component;
class KpiIndex extends Component { public function render(){ $totalClients=Client::count(); $activeProjects=Project::where('status','active')->count(); $billable=TimeEntry::where('billable',true)->sum('hours'); $all=max(TimeEntry::sum('hours'),1); $utilization=round(($billable/$all)*100,1); return view('livewire.intelligence.kpi-index',compact('totalClients','activeProjects','utilization')); } }
