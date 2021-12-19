<div>
    @if ($isAvailable !== null)
        <div @class([
            'bg-green-100' => $isAvailable,
            'bg-red-100' => !$isAvailable,
            'border-green-400' => $isAvailable,
            'border-red-400' => !$isAvailable,
            'text-green-700' => $isAvailable,
            'text-red-700' => !$isAvailable,
            'border',
            'px-4',
            'py-3',
            'rounded',
            'relative',
        ]) role="alert">
            <span class="block sm:inline">
                {{ $isAvailable == true ? ' You are available on this day!' : 'You are not available on this day!' }}

            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" wire:click="resetAvailabilityFlag">
                <svg class="fill-current h-6 w-6 text-{{ $isAvailable == true ? 'green' : 'red' }}-500" role="button"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif
    <br>
    <form wire:submit.prevent="submit">
        <input type="date" wire:model="date">
        @error('name') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Check availability</button>
    </form>
    <br>
</div>
