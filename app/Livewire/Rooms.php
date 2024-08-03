<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Rooms extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $rooms = Room::with('roomtype')->paginate(6);

        return view('livewire.rooms', [
            'rooms' => $rooms,
        ]);
    }
}
