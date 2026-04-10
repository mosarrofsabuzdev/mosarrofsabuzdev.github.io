<?php
namespace App\Livewire\Settings;
use App\Models\User;
use Livewire\Component;
class UserManagement extends Component { public function render(){ return view('livewire.settings.user-management',['users'=>User::latest()->get()]); } }
