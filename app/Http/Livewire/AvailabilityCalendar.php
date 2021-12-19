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

    public function updateDefaultAvailability($availability)
    {
        $user = auth()->user();
        if ($user->is_available !== $availability || $user->events->count()) {

            $user->is_available = $availability;
            $user->save();
            $user->events()->delete();
        }
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

    public function render()
    {
        return parent::render()->with([
            'dayColor' => auth()->user()->is_available ? 'green' : 'red',
            'eventColor' => auth()->user()->is_available ? 'red' : 'green'
        ]);
    }
}
