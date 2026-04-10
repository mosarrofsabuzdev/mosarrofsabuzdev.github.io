<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.clients-index', ['clients' => Client::paginate(10)]);
    }
}
