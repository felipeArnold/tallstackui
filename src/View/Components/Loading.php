<?php

namespace TallStackUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use TallStackUi\Support\Personalizations\Contracts\Personalization;
use TallStackUi\Support\Personalizations\SoftPersonalization;
use TallStackUi\Support\Personalizations\Traits\InteractWithProviders;
use TallStackUi\Support\Personalizations\Traits\InteractWithValidations;

#[SoftPersonalization('loading')]
class Loading extends Component implements Personalization
{
    use InteractWithProviders;
    use InteractWithValidations;

    public function __construct(
        public ?string $zIndex = null,
        public ?string $text = null,
        public ?string $loading = null,
        public ?string $delay = null,
        public ?bool $blur = false,
        public ?bool $opacity = true,
    ) {
        $this->validate();
        $this->configurations();
    }

    public function personalization(): array
    {
        return Arr::dot([
            'wrapper' => [
                'first' => 'fixed inset-0 bg-gray-300 dark:bg-dark-600',
                'second' => 'flex h-full items-center justify-center',
            ],
            'opacity' => 'bg-opacity-80 dark:bg-opacity-70',
            'blur' => 'backdrop-blur-sm',
            'spinner' => 'h-12 w-12 animate-spin text-primary-700 dark:text-white',
            'text' => 'inline-flex items-center text-lg font-semibold text-primary-500',
        ]);
    }

    public function render(): View
    {
        return view('tallstack-ui::components.loading');
    }
}
