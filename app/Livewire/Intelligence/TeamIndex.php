<?php
namespace App\Livewire\Intelligence;
use App\Models\User;
use Livewire\Component;
class TeamIndex extends Component { public function render(){ return view('livewire.intelligence.team-index',['users'=>User::withCount('tasks')->get()]); } }
