<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Simple to-do List';
    }

    //jai ajouter la methode description car je ne la trouvais pas par default a la creation de la screen

public function description(): ?string 
{
    return "Orchid Quickstart";
}

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

ModalToggle::make('Add Task')
->modal('taskModal')
->method('create')
->icon('Plus'),


        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::modal('taskModal', Layout::rows([
                Input::make('task.name')
                ->title('Nom de la tache')
                ->placeholder('Entre le nom de la tache')
                ->help('Aide moi stoplerrrrrr'),

            ]))
            ->title('Creer une tache')
            ->applyButton('boutton confirmer ajout d"une  Tache'),
        ];
    }

public function create(Request $request) {
    // valide le formulaire sauvgarde la tache dans la BDD etc
    $request->validate([
        'task.name' => 'required|max:255',

    ]);

    $task = new Task();
    $task->name = $request->input('task.name');
    $task->save();
}

}
