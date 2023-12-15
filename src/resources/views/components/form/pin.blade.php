@php
    $personalize = $classes();
    $wire = $wireable($attributes);
    $error = !$invalidate && $wire && $errors->has($wire->value());
    // We need to generate a unique id to avoid
    // conflicts when using multiple pin components
    $id = uniqid();
@endphp

@if ($wire && $wire->value())
    <div hidden x-ref="errors">@js($error)</div>
@endif

<div>
    @if ($label)
        <x-label :$label :$error/>
    @endif
    <div x-data="tallstackui_formPin(
             @entangleable($attributes),
             @js($prefix),
             @js($prefixed),
             @js($id),
             @js($length),
             @js($clear),
             @js($error),
             @js($numbers),
             @js($letters),
         )" x-on:paste="pasting = true; paste($event)" x-cloak wire:ignore>
        <div @class($personalize['wrapper'])>
            @if ($prefix)
                <input type="text"
                       value="{{ $prefix }}"
                       dusk="form_pin_prefix"
                       @class([
                           'w-[50px]',
                            $personalize['input.base'],
                            $personalize['input.color.background'],
                            $personalize['input.color.base'],
                       ]) disabled />
            @endif
            @foreach (range(1, $length) as $index)
                <input type="text"
                       id="pin-{{ $id }}-{{ $index }}"
                       dusk="pin-{{ $index }}"
                       @if ($mask) x-mask="{{ $mask }}" @endif
                       @isset($__livewire) value="{{ $wire ? $__livewire->{$wire->value()}[$index-1] ?? '' : '' }}" @endisset
                       @class([
                           'w-[38px]',
                            $personalize['input.base'],
                            $personalize['input.color.background'],
                       ]) x-bind:class="{
                           '{{ $personalize['input.color.base'] }}': !error,
                           '{{ $personalize['input.color.error'] }}': error,
                       }" maxlength="1"
                       x-on:keyup="keyup(@js($index))"
                       x-on:keyup.left="left(@js($index))"
                       x-on:keyup.right="right(@js($index))"
                       x-on:keydown.backspace="backspace(@js($index))" />
            @endforeach
            <template x-if="clear && model">
                <button class="cursor-pointer" x-on:click="erase();" dusk="form_pin_clear">
                    <x-icon name="x-circle" solid @class($personalize['button']) />
                </button>
            </template>
        </div>
    </div>
    @if ($hint && !$error)
        <x-hint :$hint/>
    @endif
    @if ($error)
        <x-error :$wire/>
    @endif
</div>
