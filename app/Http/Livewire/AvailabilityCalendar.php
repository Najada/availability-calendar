<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AvailabilityCalendar extends LivewireCalendar
{
    // public function render()
    // {
    //     return view('livewire.availability-calendar');
    // }


    public function events() : Collection
    {
        if ($this->startsAt->month == 12) {
        return collect([
            [
                'id' => 1,
                'title' => 'Breakfast',
                'description' => 'Pancakes! 🥞',
                'date' => Carbon::today(),
            ],
            [
                'id' => 2,
                'title' => 'Meeting with Pamela',
                'description' => 'Work stuff',
                'date' => Carbon::tomorrow(),
            ],
        ]);
    }
    
    return collect([]);
    }

    public function goToPreviousMonth()
    {
        $this->startsAt->subMonthNoOverflow();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();
    }


    public function onDayClick($year, $month, $day)
    {
        dd(1);
        // $this->isModalOpen = true;

        // $this->resetNewAppointment();

        // $this->newAppointment['scheduled_at'] = Carbon::today()
        //     ->setDate($year, $month, $day)
        //     ->format('Y-m-d');
    }

   
    // public function render()
    // {
    //     return parent::render()->with([
    //         'events' => $this->events()
    //     ]);
    // }
}
