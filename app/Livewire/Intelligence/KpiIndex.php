<?php

namespace App\Livewire\Intelligence;

use App\Models\Client;
use App\Models\Project;
use App\Models\TimeEntry;
use Livewire\Component;

class KpiIndex extends Component
{
    public function render()
    {
        $totalClients = Client::count();
        $activeProjects = Project::where('status', 'active')->count();
        $billableHours = TimeEntry::where('billable', true)->sum('hours');
        $allHours = TimeEntry::sum('hours');
        $utilization = $allHours > 0 ? round(($billableHours / $allHours) * 100, 1) : 0.0;

        return view('livewire.intelligence.kpi-index', compact('totalClients', 'activeProjects', 'utilization'));
    }
}
