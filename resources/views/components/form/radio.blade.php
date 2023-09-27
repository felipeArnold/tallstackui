@php
    $computed        = $attributes->whereStartsWith('wire:model')->first();
    $error           = $errors->has($computed);
    $personalization = \TasteUi\Facades\TasteUi::personalization('taste-ui::personalizations.form.radio')->toArray();
    $customize       = tasteui_personalize($personalization, $customization($error));
@endphp

<x-taste-ui::form.wrapper.radio-toggle :$computed :$error :$label :$position :$id>
    <input @if ($id) id="{{ $id }}" @endif type="radio" {{ $attributes->class($customize['base']) }} @checked($checked)>
</x-taste-ui::form.wrapper.radio-toggle>
