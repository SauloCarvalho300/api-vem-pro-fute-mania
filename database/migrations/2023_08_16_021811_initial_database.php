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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('permission');
            $table->string('document_identifier')->unique();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('tournament_type', ['C', 'R', 'P']);
            $table->string('picture_url')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document');
            $table->enum('position', [
                'GOL', 'ZAG', 'LD', 'LE', 'VOL', 'MC', 'MD', 'ME', 'MEI', 'PE', 'PD', 'SA', 'ATA'
            ]);
            $table->integer('player_number');
            $table->date('birthday')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('coach_team', function (Blueprint $table) {
            $table->unsignedBigInteger('coach_id');
            $table->unsignedBigInteger('team_id');
            $table->timestamps();

            $table->primary(['coach_id', 'team_id']);

            $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::create('regulations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('document_url')->nullable();
            $table->timestamps();
        });

        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('year');
            $table->enum('position', ['U', 'P', 'A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3']);
            $table->unsignedBigInteger('award_id')->nullable();
            $table->unsignedBigInteger('regulation_id')->nullable();
            $table->timestamps();

            $table->foreign('award_id')->references('id')->on('awards')->onDelete('set null');
            $table->foreign('regulation_id')->references('id')->on('regulations')->onDelete('set null');
        });

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_one_id')->nullable();
            $table->unsignedBigInteger('team_two_id')->nullable();
            $table->integer('score_team_one');
            $table->integer('score_team_two');
            $table->unsignedBigInteger('championships_id')->nullable();
            $table->unsignedBigInteger('referees_id')->nullable();
            $table->unsignedBigInteger('stadiums_id')->nullable();

            $table->foreign('team_one_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('team_two_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('championships_id')->references('id')->on('championships')->onDelete('set null');
            $table->foreign('referees_id')->references('id')->on('referees')->onDelete('set null');
            $table->foreign('stadiums_id')->references('id')->on('stadiums')->onDelete('set null');
        });

        Schema::create('player_game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('player_id')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('set null');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('set null');
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id')->nullable();
            $table->unsignedBigInteger('game_id')->nullable();
            $table->string('time')->nullable();
            $table->enum('card_type', ['Y', 'R']);
            $table->enum('card_step', ['G', 'O', 'Q', 'S', 'F']);
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players')->onDelete('set null');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('set null');
        });

        Schema::create('classification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->integer('score')->nullable();
            $table->integer('matches_played')->nullable();
            $table->integer('wins')->nullable();
            $table->integer('defeats')->nullable();
            $table->integer('ties')->nullable();
            $table->integer('goals_conceded')->nullable();
            $table->integer('goals_sum')->nullable();
            $table->unsignedBigInteger('championships_id')->nullable();
            $table->enum('position', ['U', 'P', 'A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3']);
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('championships_id')->references('id')->on('championships')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
