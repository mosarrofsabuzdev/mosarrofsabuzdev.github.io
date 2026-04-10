<?php

namespace App\Livewire\Settings;

use App\Models\EmailTemplate;
use Livewire\Component;

class EmailSettings extends Component
{
    public function render()
    {
        return view('livewire.settings.email-settings', ['templates' => EmailTemplate::all()]);
    }
}
