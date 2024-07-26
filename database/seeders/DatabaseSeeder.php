<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
use App\Models\Translation;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // seed pour la table section
        $randomDate = Carbon::now()->subDays(rand(0,365)); //date aleatoire avec carbon
        $tabsection = ['DWWM','TOP','PAMI','TSSR'];
    foreach($tabsection as $tabtabsection){ //parcour le tableau de section
    DB::table('section')->insert([
    'name'=>$tabtabsection,
    'created_at' => $randomDate,
        'updated_at' => $randomDate,
         ]);
    };
     // seed pour la table section
$sectionBase = db::table('section')->pluck('id')->toArray(); // pour la liste des clefs etrangères 'section 'id'



            $words = ['cat','dog','wave','swim','zebra','hydra','tiger','blender','mixer','axe','sword','bow','car','airplane'];
            $translation= ['chat','chien','zebre','hydre','tigre','blender','mixeur','hache','epe','arc','voiture','avion'];
            $isValid=['true','false','true','true','true','false','true','true','true','false','true','false'];
            $isDictionary=['false','true','true','false','false','false','true','true','true','false','true','false'];

//tableau rempli ou on va appliquer un random()
            $wordIds=[];//tableau de clef etrangere
            $collection = collect([0,1]);
            $collectionB = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);
            
            $uniqueEmailA = 'pierre'.str::random(5).'@exemple.com'; //construction email aleatoire
            $uniqueEmailB = 'paul'.str::random(5).'@exemple.com';
            $uniqueEmailC = 'jacque'.str::random(5).'@exemple.com';
            
            $postUsers=['name' => 'gordon','email' => 'freeman',
            'name' => 'maria', 'email'=> 'carrey'] ;   // tableau de users
            $collectionUsers = [$uniqueEmailA,$uniqueEmailB,$uniqueEmailC];
            $faker = \Faker\Factory::create(); // pour les faux nom prenom

//seeder avec factory pour la table USER
$randomDate = Carbon::now()->subDays(rand(0,365));//dates aleatoires avec carbon
foreach ($collectionUsers as $collectionUser){
    DB::table('users')->insert([
        'name' => $faker->name, // faux noms
        'surname' => $faker->firstName,
        'section_id' => $sectionBase[array_rand($sectionBase)], // TABLEAU DE TYPE DE SECTION ( dwwm,pami etc ) clef etrang-ère regarder dasn le tableau de db::section
        // 'sectionDate' => $randomDate,
        'email' => $collectionUser,
        'email_verified_at' => $randomDate ,
        'password' => str::random(8) ,
        'post_words' => $words[array_rand($words)],
        'post_translations' => $translation[array_rand($translation)],
        'remember_token' => Str::random(10),
        'created_at' => $randomDate,
        'updated_at' => $randomDate,
    ]);
};

    $usersIds = db::table('users')->pluck('id')->toArray(); // pour les clef etrangères on prend le db:table user et pluck sur les id que on met dans le tableau
    $motPoste = db::table('users')->pluck('post_words')->toArray(); //tableau de mot poste par le users
    // jai creer des données pour mes colonnes
        foreach($words as $word){
            $randomDate = Carbon::now()->subDays(rand(0,365));//dates aleatoires avec carbon
            $wordId = DB::table('words')->insertGetId([   //tableau de clef etrangere
            'words' => $words[array_rand($motPoste)], //mot poste par le  :post_words dans le seeder de user
            'isValid' => $collection->random(), // random du tableau collection
            'isDictionary' => $collection->random(), // random du tableau collection
            'created_at' => $randomDate,//dates aleatoires
            'updated_at' => $randomDate,//dates aleatoires
            'user_id' => $usersIds[array_rand($usersIds)], // pour les clef etrangères choisit dans le tableau db:user au harsard
        ]);
        $wordIds[] = $wordId; // tableau qui stock les instance DB::table('word')
        
    };

    
    foreach ($translation as $index => $translation){
        $randomDate = Carbon::now()->subDays(rand(0,365));//dates aleatoires avec carbon
        // $wordIds[]=$wordId;
        DB::table('translations')->insert([
'translation'=> $translation,
'isValid' => $collection->random(),// random du tableau collection
'isDictionary' => 0,// random du tableau collection
'stars' => $collectionB->random(),// random du tableau collectionB
'word_id' => $wordIds[array_rand($wordIds)],//wordids contient l'instance precedante de db:word, choisi au hasard un id dans db::table('word') dans ce tableau de l'instance db::word
'user_id' => $usersIds[array_rand($usersIds)],
'created_at' => $randomDate, //dates aleatoires
'updated_at' => $randomDate,]); //dates aleatoires

    };
   

    
       
    }
}
