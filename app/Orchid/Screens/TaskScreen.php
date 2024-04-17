<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Illuminate\Http\Request;
use App\Models\Task;
use Orchid\Screen\TD;



class TaskScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tasks'=>Task::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Ajouter un mot en anglais';
    }

    //jai ajouter la methode description car je ne la trouvais pas par default a la creation de la screen

public function description(): ?string 
{
    return "Vous pouvez ajouter un ou plusieurs mots en anglais  dans une limite de 3 mots par jour";
}

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

ModalToggle::make('Ajout du mot')
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

            Layout::table('tasks', [
                //  TD::make('name'),
            ]),

                      
            Layout::modal('taskModal', Layout::rows([
                Input::make('task.name')
                ->title('Nom de la tache')
                ->placeholder('Entre le mot')
                ->help('Aide moi stoplerrrrrr'),

            ]))
            ->title('Creer une tache')
            ->applyButton('boutton confirmer ajout d"un mot'),
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
