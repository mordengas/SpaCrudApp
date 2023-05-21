<?php

namespace App\Http\Livewire;

use App\Models\Client;

use Livewire\Component;

class ClientTable extends Component
{
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.client-table', [
            'clients' => Client::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);

    }
}
