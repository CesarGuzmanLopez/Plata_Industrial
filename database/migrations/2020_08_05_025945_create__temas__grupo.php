<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg__temas', function (Blueprint $table) {
            
            
            $table->id();
            $table->string("Nombre")->unique();
            $table->json("Descripcion")->nullable();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            
            $table->boolean("Premium")->default(false);
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('tg__curso', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->json("Descripcion")->nullable();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->boolean("Premium")->default(false);
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('tg__grados_academicos', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('tg__subtemas_difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Tema");
            $table->unsignedBigInteger("ID_Subtema");
            $table->float("valor")->default(100);
            $table->foreign("ID_Tema")->on("tg__temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Subtema")->on("tg__temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Tema','ID_Subtema']);
        });
        Schema::create('tg__curso_temas_difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Tema");
            $table->unsignedBigInteger("ID_Curso");
            $table->float("valor")->default(100);
            $table->foreign("ID_Tema")->on("tg__temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Curso")->on("tg__curso")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Tema','ID_Curso']);
        });
        Schema::create('tg__grado_cursos_difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Grado");
            $table->unsignedBigInteger("ID_Curso");
            $table->float("valor")->default(100);
            $table->foreign("ID_Grado")->on("tg__grados_academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Curso")->on("tg__curso")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Grado','ID_Curso']);
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tg__grado_cursos_difusos');
        Schema::dropIfExists('tg__curso_temas_difusos');
        Schema::dropIfExists('tg__subtemas_difusos');
        Schema::dropIfExists('tg__grados_academicos');
        Schema::dropIfExists('tg__curso');
        Schema::dropIfExists('tg__temas');
    }
}
