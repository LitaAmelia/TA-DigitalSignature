<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('kategori_id')->constrained('kategoris')->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug');
            $table->string('file');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumens');

    }
}
