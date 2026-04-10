<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactsIndex extends Component
{
    public function render()
    {
        return view('livewire.contacts-index', ['contacts' => Contact::latest()->limit(50)->get()]);
    }
}
