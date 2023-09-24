<button type="button" {{ $attributes->class($baseClass()) }}>
    <div @class(['text-white font-semibold' => $icon === null])>
        @if ($icon)
            <x-icon :$icon
                    style="{{ config('tasteui.icon') ?? 'solid' }}"
                    @class($iconClass())
            />
        @else
            {{ $text ?? $slot }}
        @endif
    </div>
</button>
