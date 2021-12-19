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
        if ($event) {
            if (auth()->user()->is_available) {
                $this->isAvailable = false;
            } else {
                $this->isAvailable = true;
            }
        }
        else {
            $this->isAvailable = false;
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
