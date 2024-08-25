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
            $table->string('words')->default('rere');
            $table->boolean('isValid')->default(true);
            $table->boolean('isDictionary')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->default(1); // je rajoute la clef etrangere venant de User et fait une refernce a cette table
            $table->boolean('isFirst')->default(false); // pour le classement en haut de file
       
        });

       

            Schema::create('translations', function(Blueprint $table){
                $table->id();
                $table->string('translation')->nullable();
                $table->boolean('isValid');
                $table->boolean('isDictionary');
                $table->smallinteger('stars');
                $table->unsignedBigInteger('word_id');
                $table->unsignedBigInteger('user_id');
                $table->smallinteger('nombreTraduc')->nullable();
                $table->foreign('word_id')->references('id')->on('words');
                $table->foreign('user_id')->references('id')->on('users'); // clef etrangère venant de User
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
