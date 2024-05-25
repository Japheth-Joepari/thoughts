<form wire:submit.prevent="toggleClap" id="clap-form">
    <button type="submit" style="border: transparent; background: transparent">
        <i class="fa-sharp fa-solid fa-hands-clapping btn btn-primary text-white" id="clap-count">
            @if ($clapCount != 0)
                ({{ $clapCount }})
            @endif
        </i>
    </button>
</form>
