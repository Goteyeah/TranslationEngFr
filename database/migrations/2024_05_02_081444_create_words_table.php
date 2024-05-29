<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('words');
            $table->boolean('isValid');
            $table->boolean('isDictionary');
            //$table->unique(['words','isValid'],'colonne');
            $table->foreign('user_id')->references('id')->on('User'); // je rajoute la clef etrangere venant de User et fait une refernce a cette table
            
       
        });

       ;

            Schema::create('translations', function(Blueprint $table){
                $table->id();
                $table->string('translation');
                $table->boolean('isValid');
                $table->boolean('isDictionary');
                $table->smallinteger('stars');
                $table->unsignedBigInteger('word_id');
                $table->foreign('word_id')->references('id')->on('words');
                $table->foreign('user_id')->reference('id')->on('User'); // clef etrangère venant de User
                $table->timestamps();

             });

              }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
