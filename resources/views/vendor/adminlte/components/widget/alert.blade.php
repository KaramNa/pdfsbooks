<div {{ $attributes->merge(['class' => $makeAlertClass()]) }}>

    {{-- Dismiss button --}}
    @isset($dismissable)
        <form action="{{ $theme }}" method="post">
            @csrf
            <button type="submit" class="close text-decoration-none" aria-hidden="true">
                &times;
            </button>
        </form>
    @endisset

    {{-- Alert header --}}
    @if (!empty($title) || !empty($icon))
        <h5>
            @if (!empty($icon))
                <i class="icon {{ $icon }}"></i>
            @endif

            @if (!empty($title))
                {{ $title }}
            @endif
        </h5>
    @endif

    {{-- Alert content --}}
    {{ $slot }}

</div>
