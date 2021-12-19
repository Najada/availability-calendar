{{-- <div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']  }}')"
    @endif
    class="bg-red rounded-lg border py-2 px-3 shadow-md cursor-pointer" style="background-color:red">

    <p class="text-sm font-medium">
        {{ $event['title'] }}
    </p>
    <p class="mt-2 text-xs">
        {{ $event['description'] ?? 'No description' }}
    </p>
</div> --}}

<div class="events events--{{$eventColor}}">

</div>