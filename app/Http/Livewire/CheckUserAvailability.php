<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckUserAvailability extends Component
{
    public $date;
    public $isAvailable = null;

    public function submit()
    {
        $event = auth()->user()->events()->where('date', $this->date)->first();
        $eventExists = $event !== null;
        if (auth()->user()->is_available) {
            if ($eventExists) {
                $this->isAvailable = false;
            } else {
                $this->isAvailable = true;
            }
        } else {
            if ($eventExists) {
                $this->isAvailable = true;
            } else {
                $this->isAvailable = false;
            }
        }
    }

    public function resetAvailabilityFlag()
    {
        $this->isAvailable = null;
    }

    public function render()
    {
        return view('livewire.check-user-availability');
    }
}
