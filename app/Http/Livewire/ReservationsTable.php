<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class ReservationsTable extends Component
{

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.reservations-table', [
            'reservations' => Reservation::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),

        ]);

    }
}
