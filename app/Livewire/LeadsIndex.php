<?php

namespace App\Livewire;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class LeadsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.leads-index', ['leads' => Lead::latest()->paginate(10)]);
    }
}
