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
        Schema::create('TG__Temas', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->boolean("Premium")->default(false);
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('TG__Curso', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->boolean("Premium")->default(false);
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('TG__Grados_Academicos', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('TG__Subtemas_Difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Tema");
            $table->unsignedBigInteger("ID_Subtema");
            $table->float("valor")->default(100);
            $table->foreign("ID_Tema")->on("TG__Temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Subtema")->on("TG__Temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Tema','ID_Subtema']);
        });
        Schema::create('TG__Curso_Temas_Difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Tema");
            $table->unsignedBigInteger("ID_Curso");
            $table->float("valor")->default(100);
            $table->foreign("ID_Tema")->on("TG__Temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Curso")->on("TG__Curso")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Tema','ID_Curso']);
        });
        Schema::create('TG__Grado_Cursos_difusos', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Grado");
            $table->unsignedBigInteger("ID_Curso");
            $table->float("valor")->default(100);
            $table->foreign("ID_Grado")->on("TG__Grados_Academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Curso")->on("TG__Curso")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('TG__Grado_Cursos_difusos');
        Schema::dropIfExists('TG__Curso_Temas_Difusos');
        Schema::dropIfExists('TG__Subtemas_Difusos');
        Schema::dropIfExists('TG__Grados_Academicos');
        Schema::dropIfExists('TG__Curso');
        Schema::dropIfExists('TG__Temas');
    }
}
