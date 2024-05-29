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
        // User::factory(10)->create();

        // // User::factory()->create([
        // //     'name' => 'Test User',
        // //     'email' => 'test@example.com',
        // // ]);


            $words = ['cat','dog','zebra','hydra','tiger','blender','mixer','axe','sword','bow','car','airplane'];
            $translation= ['chat','chien','zebre','hydre','tigre','blender','mixeur','hache','epe','arc','voiture','avion'];
            $isValid=['true','false','true','true','true','false','true','true','true','false','true','false'];
            $isDictionary=['false','true','true','false','false','false','true','true','true','false','true','false'];

//tableau rempli ou on va appliquer un random()
            $wordIds=[];//tableau de clef etrangere
            $collection = collect([0,1]);
            $collectionB = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]);


            // jai creer des données pour mes colonnes
        foreach($words as $word){
            $randomDate = Carbon::now()->subDays(rand(0,365));//dates aleatoires avec carbon
            $wordId = DB::table('words')->insertGetId([   //tableau de clef etrangere
            'words' => $word,
            'isValid' => $collection->random(), // random du tableau collection
            'isDictionary' => $collection->random(), // random du tableau collection
            'created_at' => $randomDate,//dates aleatoires
            'updated_at' => $randomDate,//dates aleatoires
        ]);
        $wordIds[]=$wordId;
    };

    foreach ($translation as $index => $translation){
        $randomDate = Carbon::now()->subDays(rand(0,365));//dates aleatoires avec carbon
        DB::table('translations')->insert([
'translation'=> $translation,
'isValid' => $collection->random(),// random du tableau collection
'isDictionary' => $collection->random(),// random du tableau collection
'stars' => $collectionB->random(),// random du tableau collectionB
'word_id' => $wordIds[$index] ,//tableau de clef etrangere
'created_at' => $randomDate, //dates aleatoires
            'updated_at' => $randomDate,]); //dates aleatoires

    };
       


// utiliser des tableaus dans les tableau et faire un foreach.
    
    


        
   
    
    
       
    }
}
