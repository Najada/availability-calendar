<?php

namespace Tests\Feature;

use App\Http\Livewire\AvailabilityCalendar;
use App\Http\Livewire\CheckUserAvailability;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\User;

class AvailabilityCalendarTest extends TestCase
{
    /**
     * @return void
     **/
    public function test_event_creation()
    {
        $user = User::factory()->create();

        $year = '2022';
        $month = '10';
        $day = '4';
        Livewire::actingAs($user)->test(AvailabilityCalendar::class)
            ->call('onDayClick', $year, $month, $day);
            
        $this->assertTrue($user->events()->where('date', "{$year}-{$month}-{$day}")->exists());

        Livewire::actingAs($user)->test(AvailabilityCalendar::class)
        ->call('updateDefaultAvailability', 1);

        $this->assertTrue($user->is_available === 1);
        $this->assertTrue($user->events()->count() === 0);
    }

    public function test_user_availability_on_always_available()
    {
        $user = User::factory()->create();

        $year = '2022';
        $month = '10';
        $day = '4';
        Livewire::actingAs($user)->test(AvailabilityCalendar::class)
            ->call('onDayClick', $year, $month, $day);
            
        $user->is_available = 1;
        Livewire::actingAs($user)->test(CheckUserAvailability::class)
        ->set('date', "{$year}-{$month}-{$day}")
        ->call('submit')
        ->assertSet('isAvailable', false);
    }

    public function test_user_availability_on_always_not_available()
    {
        $user = User::factory()->create();

        $year = '2022';
        $month = '10';
        $day = '4';
        Livewire::actingAs($user)->test(AvailabilityCalendar::class)
            ->call('onDayClick', $year, $month, $day);
        $user->is_available = 0;
        Livewire::actingAs($user)->test(CheckUserAvailability::class)
        ->set('date', "{$year}-{$month}-{$day}")
        ->call('submit')
        ->assertSet('isAvailable', true);
    }

}
