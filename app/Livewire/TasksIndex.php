<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksIndex extends Component
{
    public function render()
    {
        return view('livewire.tasks-index', ['tasks' => Task::latest()->limit(50)->get()]);
    }
}
