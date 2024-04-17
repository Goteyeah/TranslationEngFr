<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
// on ajouter tout ca
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
//  on ajouter tout ca




class PostEditScreen extends Screen
{
    public $post;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Post $post): array
    {
        return [
            'post' => $post
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->post->exists ? 'Edit post' : 'Creating a new post';
    }

public function description(): ?string
{
    return 'blog possssssst';
}

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    // les commandes sont comme des commandes d'un tableau de bord comme les bouton d'une calculatrice
    public function commandBar(): array
    {
        return [
            Button::make('Creer un post')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->post->exists),
       
            Button::make('Mettre à jour un post')
            ->icon('note')
            ->method('createOrUpdate')
            ->canSee($this->post->exists), 

            Button::make('Supprimer un post')
            ->icon('Poubelle')
            ->method('createOrUpdate')
            ->canSee($this->post->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
// ICI il y a la vue ou le modele de la vue ou le layout ou tout sera affiché

    public function layout(): array
    {
        return [
            Layout::rows([
                input::make('post.title')
                ->title('MOT ANGLAIS')
                ->placeholder('placeholder mystereux Pour mon mot en anglais')
                ->help('une description ou un titre pour le post'),

            TextArea::make('post.description')
            ->title('Description en gros')
            ->rows(3)
            ->maxlenght(200)
            ->placeholder('description bref pour la preview'),

             //"Relation" fait une correspondance automatique 
             //quand on veut remplir l"autheur si on s'inscrit on retrouve le nickname dans la liste des autheurs

            Relation::make('post.Autheur')
            ->title('author')
            ->fromModel(User::class,'name'),
                // "Quill" pour ajouter des fichiers comme des images etc
            Quill::make('post.body')
            ->title("texte principale ou je vais proposer mes traduction françcaises"),
            ])
        ];
    }

public function createOrUpdate(Request $request) {
   
   
    $this->post->fill($request->get('post'))->save();
   
    Alert::info('BRAVO vous avez "created" le post');

    return redirect()->route('platform.post.list');

}

 /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->post->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.post.list');
    }

}
