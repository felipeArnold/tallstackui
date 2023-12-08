<?php

namespace TallStackUi\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;
use TallStackUi\View\Components\Form\Traits\SetupRadioCheckboxToggle;
use TallStackUi\View\Personalizations\Contracts\Personalization;
use TallStackUi\View\Personalizations\SoftPersonalization;
use TallStackUi\View\Personalizations\Traits\InteractWithProviders;

#[SoftPersonalization('form.checkbox')]
class Checkbox extends Component implements Personalization
{
    use InteractWithProviders;
    use SetupRadioCheckboxToggle;

    public function __construct(
        public ?string $id = null,
        public string|null|ComponentSlot $label = null,
        public ?string $xs = null,
        public ?string $sm = null,
        public ?string $md = null,
        public ?string $lg = null,
        public ?string $size = null,
        public ?string $position = 'right',
        public ?string $color = 'primary',
    ) {
        $this->setup();
        $this->colors();
    }

    public function personalization(): array
    {
        return Arr::dot([
            'input' => [
                'class' => 'form-checkbox border-secondary-200 rounded transition duration-100 ease-in-out',
                'sizes' => [
                    'xs' => 'h-3 w-3',
                    'sm' => 'h-4 w-4',
                    'md' => 'h-5 w-5',
                    'lg' => 'h-6 w-6',
                ],
            ],
            'error' => 'border border-red-300 text-red-600 focus:border-red-400 focus:ring-red-600',
        ]);
    }

    public function render(): View
    {
        return view('tallstack-ui::components.form.checkbox');
    }
}
