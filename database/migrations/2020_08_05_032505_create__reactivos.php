<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reactivos__Temas_Interest', function (Blueprint $table) {
            $table->id();
            $table->string("Tema")->unique();
            $table->float("Popularidad")->default(0);
            $table->timestamps();
        });
        /**
         * Un grupo al que pertenece un tipo de preguntas ejemplo opcion multiple, aleatoria, construlle.
         */
        Schema::create('Reactivos__Grupos_Tipos', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->timestamps();
        });
        Schema::create('Reactivos__Tipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Grupo")->nullable();
            $table->string("Nombre_Tipo")->unique();
            $table->string("Ruta")->unique();
            $table->text("Datos");
            $table->boolean("Activo")->default(false);
            $table->timestamps();
            $table->foreign("ID_Grupo")->on("Reactivos__Grupos_Tipos")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('Reactivos__Reactivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Grupo_Reactivos")->nullable();
            $table->unsignedBigInteger("ID_Tema")->nullable();
            $table->unsignedBigInteger("ID_Tema_Interes")->nullable();
            $table->unsignedBigInteger("ID_Creador")->nullable();
            $table->string("Nombre")->unique();
            $table->longText("Enunciado")->nullable();
            $table->longText("Datos")->nullable();            
            $table->foreign("ID_Grupo_Reactivos")->on("Reactivos__Grupos_Tipos")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema")->on("TG__Temas")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Interes")->on("Reactivos__Temas_Interest")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('Reactivos__Opciones', function (Blueprint $table) {
            $table->id();
            $table->string("Enunciado1");
            $table->longText("Datos1")->nullable();
            $table->string("Enunciado2");
            $table->longText("Datos2")->nullable();
        });
        Schema::create('Reactivos__Reactivos_Opciones', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Opcion");
            $table->float("valor")->default(100);
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Opcion")->on("Reactivos__Opciones")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Reactivo','ID_Opcion']);
        });
        Schema::create('Reactivos__Datos_Extras', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->longText("Datos");
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Reactivo']);
        });
        Schema::create('Reactivos__Estadisticas', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_tipo");
            $table->unsignedBigInteger("ID_Grado");
            $table->float("valor")->default(100);
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_tipo")->on("Reactivos__Tipos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("TG__Grados_Academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("Numero_De_Preguntas")->default(0);
            $table->float("Suma_valor")->default(0);
            $table->float("Suma_tiempo")->default(0);
            $table->primary(['ID_Reactivo','ID_tipo','ID_Grado']);
        });
        Schema::create('Reactivos__Retroalimentacion', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Grado") ;
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("TG__Grados_Academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->json("Retroalimentacion")->nullable();
            $table->primary(['ID_Reactivo','ID_Grado']);
        });
        Schema::create('Reactivos__Popularidad', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Grado") ;
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("TG__Grados_Academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->float("Valor")->default(0)->nullable();
            $table->float("Dificultad_Alumnos")->default(0)->nullable();
            $table->float("Dificultad_Creador")->default(0)->nullable();
            $table->float("Dificultad_Maestros")->default(0)->nullable();
            $table->json("Neuronas")->nullable();
            $table->primary(['ID_Reactivo','ID_Grado']);
        });                
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Reactivos__Popularidad');
        Schema::dropIfExists('Reactivos__Retroalimentacion');
        Schema::dropIfExists('Reactivos__Estadisticas');
        Schema::dropIfExists('Reactivos__Datos_Extras');
        Schema::dropIfExists('Reactivos__Reactivos_Opciones');
        Schema::dropIfExists('Reactivos__Opciones');
        Schema::dropIfExists('Reactivos__Reactivos');
        Schema::dropIfExists('Reactivos__Tipos');
        Schema::dropIfExists('Reactivos__Grupos_Tipos');
        Schema::dropIfExists('Reactivos__Temas_Interest');
    }
}
