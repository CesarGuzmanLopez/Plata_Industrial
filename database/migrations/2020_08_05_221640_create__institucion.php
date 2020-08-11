<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;

class CreateInstitucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('institucion__institucion', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre_institucion");
            $table->unsignedBigInteger("ID_Responsable");
            $table->unsignedBigInteger("ID_Responsable2")->nullable();
            $table->unsignedBigInteger("ID_Membrecia")->nullable();
            $table->bigInteger("Numero_docentes_maximos")->default(1);
            $table->bigInteger("Numero_grupos_maximos")->default(1);
            $table->bigInteger("Numero_alumnos_por_curso")->default(1);
            $table->foreign("ID_Responsable")->on("users")->references("id");
            $table->foreign("ID_Responsable2")->on("users")->references("id");
            $table->foreign("ID_Membrecia")->on("membresias__membresia")->references("id");
            $table->timestamps();
        });
        Schema::create('institucion__profesores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_profesor");
            $table->unsignedBigInteger("ID_institucion");
            $table->foreign("ID_profesor")->on("users")->references("id");
            $table->foreign("ID_institucion")->on("institucion__institucion")->references("id");
            $table->string("Grado_Estudio")->comment("Grado en el que esta el profesor")->nullable();
            $table->string("Descripcion")->comment("")->nullable();
           $table->timestamps();
        });
        Schema::create('institucion__alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Alumno");
            $table->unsignedBigInteger("ID_institucion");
            $table->foreign("ID_Alumno")->on("users")->references("id");
            $table->foreign("ID_institucion")->on("institucion__institucion")->references("id");
            $table->string("Grado_Estudio")->comment("Grado en el que esta el profesor")->nullable();
            $table->string("Descripcion")->comment("")->nullable();
            $table->timestamps();
        });
        Schema::create('institucion__grupos',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("ID_Institucion");
            $table->unsignedBigInteger("ID_Profesor");
            $table->unsignedBigInteger("ID_Curso");
            $table->text("Descripcion");
            $table->json("Data");
            $table->foreign("ID_Institucion")->on("institucion__institucion")->references("id");
            $table->foreign("ID_Profesor")->on("institucion__profesores")->references("id");
            $table->foreign("ID_Curso")->on("tg__curso")->references("id");
           $table->timestamps();
        });
        Schema::create("institucion__grupo_alumnos", function (Blueprint $table){
            $table->unsignedBigInteger("ID_Grupo");
            $table->unsignedBigInteger("ID_Alumno");
            $table->integer("Numero_lista");
            $table->boolean("Activo");
            $table->foreign("ID_Grupo")->on("institucion__grupos")->references("id");
            $table->foreign("ID_Alumno")->on("institucion__alumnos")->references("id");
            $table->primary(["ID_Grupo","ID_Alumno"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucion__grupo_alumnos');
        Schema::dropIfExists('institucion__grupos');
        Schema::dropIfExists('institucion__alumnos');
        Schema::dropIfExists('institucion__profesores');
        Schema::dropIfExists('institucion__institucion');
    }
}
