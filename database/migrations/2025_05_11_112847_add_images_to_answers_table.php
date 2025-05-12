<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('answers', function (Blueprint $table) {
        $table->json('images')->nullable(); // store multiple images as JSON
    });
}

public function down()
{
    Schema::table('answers', function (Blueprint $table) {
        $table->dropColumn('images');
    });
}

};
