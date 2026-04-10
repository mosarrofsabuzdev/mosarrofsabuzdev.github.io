<?php
namespace App\Livewire;
use App\Models\ManagedFile;
use Livewire\Component;
class FilesIndex extends Component { public function render(){ return view('livewire.files-index',['files'=>ManagedFile::latest()->limit(50)->get()]); } }
