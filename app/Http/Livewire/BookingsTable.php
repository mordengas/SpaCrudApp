<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingsTable extends Component
{
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public function render()
    {
        return view('livewire.bookings-table', [
            'bookings' => Booking::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
