<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Asantibanez\LivewireCalendar\LivewireCalendar;
use Illuminate\Support\Collection;

class AvailabilityCalendar extends LivewireCalendar
{
    public function events(): Collection
    {

        return Event::whereDate('date', '>=', $this->gridStartsAt)
            ->whereDate('date', '<=', $this->gridEndsAt)
            ->get()
            ->map(function (Event $model) {
                return [
                    'id' => $model->id,
                    'title' => 'title',
                    'description' => 'notes',
                    'date' => $model->date,
                ];
            });
    }

    public function goToPreviousMonth()
    {
        $this->startsAt->subMonthNoOverflow();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();
    }


    public function onDayClick($year, $month, $day)
    {
        $event = null;
        if ($event = auth()->user()->events()->where('date', "{$year}-{$month}-{$day}")->first()) {
            $event->delete();
        } else {
            auth()->user()->events()->create([
                'date' => "{$year}-{$month}-{$day}"
            ]);
        }
    }
}
