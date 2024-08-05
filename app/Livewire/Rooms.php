<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Rooms extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $checkin_date;
    public $checkout_date;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);
    }

    public function filterRooms()
    {
        logger("Checkin Date: {$this->checkin_date}");
        logger("Checkout Date: {$this->checkout_date}");

        $this->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        // Trigger re-render with filtered rooms
        $this->render();
    }

    public function render()
    {
        $rooms = Room::with('roomtype');

        if ($this->checkin_date && $this->checkout_date) {
            $rooms = $rooms->whereDoesntHave('bookings', function($query) {
                $query->where(function($query) {
                    $query->whereBetween('checkin_date', [$this->checkin_date, $this->checkout_date])
                          ->orWhereBetween('checkout_date', [$this->checkin_date, $this->checkout_date]);
                })->orWhere(function($query) {
                    $query->where('checkin_date', '<', $this->checkin_date)
                          ->where('checkout_date', '>', $this->checkout_date);
                });
            });
        }

        $rooms = $rooms->paginate(6);

        return view('livewire.rooms', [
            'rooms' => $rooms,
        ]);
    }
}
