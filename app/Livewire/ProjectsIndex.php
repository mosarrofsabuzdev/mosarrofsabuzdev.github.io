<?php
namespace App\Livewire;
use App\Models\Project;
use Livewire\Component;
class ProjectsIndex extends Component { public function render(){ return view('livewire.projects-index',['projects'=>Project::latest()->paginate(12)]);} }
