<?php

namespace TallStackUi\View\Personalizations\Support\Colors;

use Illuminate\Support\Arr;
use TallStackUi\Facades\TallStackUi;
use TallStackUi\View\Components\Button\Button;
use TallStackUi\View\Components\Button\Circle;
use TallStackUi\View\Personalizations\Support\TailwindClassBuilder;

// TODO: refactor
class ButtonColors
{
    public function __construct(protected Button|Circle $component, protected array $variations = [])
    {
        $this->variations = match ($this->component->color) {
            'white' => [
                'text' => 'neutral',
                'ring' => 'neutral',
                'hover:bg' => 'neutral',
                'hover:ring' => 'neutral',
                'border' => 'neutral',
                'bg' => 'neutral',
            ],
            default => [
                'text' => $this->component->color,
                'ring' => $this->component->color,
                'hover:bg' => $this->component->color,
                'hover:ring' => $this->component->color,
                'border' => $this->component->color,
                'bg' => $this->component->color,
            ]
        };
    }

    public function __invoke(): array
    {
        return [
            'wrapper.color' => $this->button(),
            'icon.color' => $this->icon(),
            'icon.loading.color' => Arr::toCssClasses([
                TallStackUi::tailwind()
                    ->when($this->component->color === 'white', fn (TailwindClassBuilder $color) => $color->set('text', 'black'))
                    ->unless($this->component->color === 'white', fn (TailwindClassBuilder $color) => $color->set('text', 'white'))
                    ->get() => $this->component->style === 'solid',
                TallStackUi::tailwind()
                    ->when($this->component->color === 'white', fn (TailwindClassBuilder $color) => $color->set('text', 'black'))
                    ->unless($this->component->color === 'white', fn (TailwindClassBuilder $color) => $color->set('text', $this->component->color, 500))
                    ->get() => $this->component->style === 'outline',
            ]),
        ];
    }

    private function button(): string
    {
        $color = $this->text(TallStackUi::tailwind());

        $this->solid($color)->get();
        $this->outline($color)->get();

        $color->clean(false)
            ->merge('dark:ring-offset', 'dark', 900);

        return $color->get();
    }

    private function icon(): string
    {
        $weight = (match ($this->component->style !== 'outline') {
            true => fn () => $this->component->color === 'white' ? 950 : 50,
            false => fn () => in_array($this->component->color, ['black', 'white']) ? 950 : 500,
        })();

        return TallStackUi::tailwind()
            ->set('text', $this->variations['text'], $weight)
            ->get();
    }

    private function outline(TailwindClassBuilder $color): TailwindClassBuilder
    {
        $variation = match ($this->component->color) {
            'white' => [
                'border' => 200,
                'ring' => 200,
                'hover:bg' => 50,
                'hover:ring' => 200,
            ],
            'black' => [
                'border' => null,
                'ring' => null,
                'hover:bg' => 50,
                'hover:ring' => null,
            ],
            default => [
                'border' => 500,
                'ring' => 500,
                'hover:bg' => 50,
                'hover:ring' => 600,
            ]
        };

        return $color->when($this->component->style === 'outline', function (TailwindClassBuilder $color) use ($variation) {
            return $color->set('border', $this->variations['border'], $variation['border'])
                ->set('ring', $this->variations['ring'], $variation['ring'])
                ->set('hover:bg', $this->variations['hover:bg'], $variation['hover:bg'])
                ->set('hover:ring', $this->variations['hover:ring'], $variation['hover:ring'])
                ->append('dark:hover:bg-slate-700')
                ->append('border');
        });
    }

    private function solid(TailwindClassBuilder $color): TailwindClassBuilder
    {
        $variation = match ($this->component->color) {
            'white' => [
                'bg' => 50,
                'ring' => 200,
                'hover:bg' => 200,
                'hover:ring' => 200,
            ],
            'black' => [
                'bg' => null,
                'ring' => null,
                'hover:bg' => null,
                'hover:ring' => null,
            ],
            default => [
                'bg' => 500,
                'ring' => 500,
                'hover:bg' => 600,
                'hover:ring' => 600,
            ]
        };

        return $color->when($this->component->style === 'solid', function (TailwindClassBuilder $color) use ($variation) {
            return $color->set('ring', $this->variations['ring'], $variation['ring'])
                ->set('hover:bg', $this->variations['hover:bg'], $variation['hover:bg'])
                ->set('hover:ring', $this->variations['hover:ring'], $variation['hover:ring'])
                ->set('bg', $this->variations['bg'], $variation['bg']);
        });
    }

    private function text(TailwindClassBuilder $color): TailwindClassBuilder
    {
        $weights = [
            'solid' => match ($this->component->color) {
                'white' => 700,
                default => 50,
            },
            'outline' => match ($this->component->color) {
                'white' => 700,
                'black' => null,
                default => 500,
            },
        ];

        return $color->set('text', $this->variations['text'], $weights[$this->component->style])
            ->mergeWhen($this->component->style === 'outline' && $this->component->color === 'white', 'dark:text', 'white');
    }
}
