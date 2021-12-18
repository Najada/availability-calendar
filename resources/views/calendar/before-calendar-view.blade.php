<div class="month" >
    <div>
        {{$this->startsAt->format('F Y')}}
    </div>

    <div>
        <a wire:click="goToPreviousMonth()">Prev</a> |
        <a wire:click="goToNextMonth()">Next</a>
    </div>
  
</div>