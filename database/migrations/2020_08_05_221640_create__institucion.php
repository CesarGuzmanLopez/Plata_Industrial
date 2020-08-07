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
    Schema::create('Institucion__Institucion', function (Blueprint $table) {
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
        Schema::create('Institucion__Profesores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_profesor");
            $table->unsignedBigInteger("ID_institucion");
            $table->foreign("ID_profesor")->on("users")->references("id");
            $table->foreign("ID_institucion")->on("Institucion__Institucion")->references("id");
            $table->string("Grado_Estudio")->comment("Grado en el que esta el profesor")->nullable();
            $table->string("Descripcion")->comment("")->nullable();
           $table->timestamps();
        });
        Schema::create('Institucion__Alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Alumno");
            $table->unsignedBigInteger("ID_institucion");
            $table->foreign("ID_Alumno")->on("users")->references("id");
            $table->foreign("ID_institucion")->on("Institucion__Institucion")->references("id");
            $table->string("Grado_Estudio")->comment("Grado en el que esta el profesor")->nullable();
            $table->string("Descripcion")->comment("")->nullable();
            $table->timestamps();
        });
        Schema::create('Institucion__Grupos',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger("ID_Institucion");
            $table->unsignedBigInteger("ID_Profesor");
            $table->unsignedBigInteger("ID_Curso");
            $table->text("Descripcion");
            $table->json("Data");
            $table->foreign("ID_Institucion")->on("Institucion__Institucion")->references("id");
            $table->foreign("ID_Profesor")->on("Institucion__Profesores")->references("id");
            $table->foreign("ID_Curso")->on("TG__Curso")->references("id");
           $table->timestamps();
        });
        Schema::create("Institucion__Grupo_Alumnos", function (Blueprint $table){
            $table->unsignedBigInteger("ID_Grupo");
            $table->unsignedBigInteger("ID_Alumno");
            $table->integer("Numero_lista");
            $table->boolean("Activo");
            $table->foreign("ID_Grupo")->on("Institucion__Grupos")->references("id");
            $table->foreign("ID_Alumno")->on("Institucion__Alumnos")->references("id");
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
        Schema::dropIfExists('Institucion__Grupo_Alumnos');
        Schema::dropIfExists('Institucion__Grupos');
        Schema::dropIfExists('Institucion__Alumnos');
        Schema::dropIfExists('Institucion__Profesores');
        Schema::dropIfExists('Institucion__Institucion');
    }
}
