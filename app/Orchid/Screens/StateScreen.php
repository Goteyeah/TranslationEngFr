<?php

namespace App\Orchid\Screens;
// ce que j'ai ajouté
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
//ce que j'ai ajouté

class StateScreen extends Screen
{
    public $clicks;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'clicks' => $this->clicks ?? 0,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'State Coucou ou clic de popularité';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        // nombre de clics
        return [
            Layout::rows([
                Label::make('clicks')
                    ->title('Ca compte les clics'),

                    Button::make('Incrémentation du clic')
                    ->type(Color::DARK)
                    ->method('increment'),
            ]),
        ];
        // nombre de clics
    }

    public function increment(Request $request){
        $this->clicks++;
    }
}
