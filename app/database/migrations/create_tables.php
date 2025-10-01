<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Livro', function (Blueprint $table) {
            $table->increments('Codl');
            $table->string('Titulo', 40);
            $table->string('Editora', 40);
            $table->string('AnoPublicacao', 4);
            $table->integer('Preco');
        });

        Schema::create('Autor', function (Blueprint $table) {
            $table->increments('CodAu');
            $table->string('Nome', 40);
        });

        Schema::create('Livro_Autor', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('Livro_Codl');
            $table->unsignedInteger('Autor_CodAu');

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->onDelete('cascade');

            $table->foreign('Autor_CodAu')
                ->references('CodAu')
                ->on('Autor')
                ->onDelete('cascade');
        });

        Schema::create('Assunto', function (Blueprint $table) {
            $table->increments('codAs');
            $table->string('Descricao', 20);
        });

        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->increments('Id');
            $table->unsignedInteger('Livro_Codl');
            $table->unsignedInteger('Assunto_codAs');

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->onDelete('cascade');

            $table->foreign('Assunto_codAs')
                ->references('codAs')
                ->on('Assunto')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
        Schema::dropIfExists('Assunto');
        Schema::dropIfExists('Livro_Autor');
        Schema::dropIfExists('Autor');
        Schema::dropIfExists('Livro');
    }
};
