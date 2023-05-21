<?php

namespace App\Http\Livewire;

use App\Models\Treatment;

use Livewire\Component;

class TreatmentsTable extends Component
{
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.treatments-table', [
            'treatments' => Treatment::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
