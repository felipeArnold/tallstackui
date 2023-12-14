<?php

it('can render', function () {
    $component = <<<'HTML'
    <x-tab selected="Foo">
        <x-tab.items tab="A">
            Foo
        </x-tab.items>
        <x-tab.items tab="B">
            Bar
        </x-tab.items>
    </x-tab>
HTML;

    $this->blade($component)
        ->assertSee('Foo')
        ->assertSee('Bar');
});
