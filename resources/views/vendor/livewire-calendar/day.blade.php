
<div
    class="flex-1 h-40 lg:h-48 border border-gray-200 -mt-px -ml-px"
    style="min-width: 10rem;position: relative;z-index:9">

    <div
        class="w-full h-full"
        id="{{ $componentId }}-{{ $day }}">

        <div
            @if($dayClickEnabled)
                wire:click="onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})"
            @endif
            class="w-full h-full p-2 {{ $dayInMonth ? $isToday ? 'bg-yellow-100' : ' bg-white ' : 'bg-gray-100' }} flex flex-col" style="background-color: {{$dayColor}}">

            <div class="flex items-center" style="z-index:88">
                <p class="text-sm {{ $dayInMonth ? ' font-medium ' : '' }}">
                    {{ $day->format('j') }}
                </p>

            </div>

            <div class="p-2 my-2 flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 grid-flow-row gap-2">
                    @foreach($events as $event)
                        <div
                            @if($dragAndDropEnabled)
                                draggable="true"
                            @endif
                            ondragstart="onLivewireCalendarEventDragStart(event, '{{ $event['id'] }}')">
                            @include($eventView, [
                                'event' => $event,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
