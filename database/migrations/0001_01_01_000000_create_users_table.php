<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //ajouter tout au debut car on a besoin de creer section qui est référencé dans user
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name")->default('FIRST');
    //ajouter tout au debut car on a besoin de creer section qui est référencé dans user

        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        // ajouté
           $table->unsignedBigInteger('section_id')->nullable();
           $table->foreign('section_id')->references('id')->on('section')->nullable();
           $table->string('surname');
           $table->boolean('genre')->nullable();
           $table->boolean('blocked')->default(false); // bloquage par mail
           $table->integer('stars')->default(7);
           $table->char('language')->default('fr'); // langue pour le App::setlocale() poir le user.
           $table->date('starsDate')->default(Carbon::createFromDate(2024,7,1));
           //  ajouté
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('post_words')->nullable(); // je rajoute les colonnes de words en possibilité NULL
            $table->string('post_translations')->nullable(); // je rajoute les colonnes translations en possibilité NULL
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
