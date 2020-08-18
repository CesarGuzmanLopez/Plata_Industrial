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
        Schema::create('reactivos__temas_interest', function (Blueprint $table) {
            $table->id();
            $table->string("Tema")->unique();
            $table->float("Popularidad")->default(0);
            $table->timestamps();
        });
        /**
         * Un grupo al que pertenece un tipo de preguntas ejemplo opcion multiple, aleatoria, construlle.
         */
        Schema::create('reactivos__grupos_tipos', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique();
            $table->string("Descripcion");
            $table->timestamps();
        });
        Schema::create('reactivos__tipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Grupo")->nullable();
            $table->string("Nombre_Tipo")->unique();
            $table->string("Ruta")->unique()->nullable();
            $table->json("Datos");
            $table->boolean("Activo")->default(false);
            $table->timestamps();
            $table->foreign("ID_Grupo")->on("reactivos__grupos_tipos")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('reactivos__reactivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Grupo_Reactivos")->nullable();
            $table->unsignedBigInteger("ID_Tema")->nullable();
            $table->unsignedBigInteger("ID_Tema_Interes")->nullable();
            $table->unsignedBigInteger("ID_Creador")->nullable();
            $table->string("Nombre")->unique();
            $table->longText("Enunciado")->nullable();
            $table->json("Datos")->nullable();            
            $table->foreign("ID_Grupo_Reactivos")->on("reactivos__grupos_tipos")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema")->on("tg__temas")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Interes")->on("reactivos__temas_interest")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        Schema::create('reactivos__opciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Tipo_Pregunta')->nullable();
            $table->longText("Enunciado1");
            $table->json("Datos1")->nullable();
            $table->longText("Enunciado2")->nullable();
            $table->json("Datos2")->nullable();
            $table->foreign("ID_Tipo_Pregunta")->on("reactivos__grupos_tipos")->references("id")->cascadeOnUpdate();
            
        });
        Schema::create('reactivos__reactivos_opciones', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Opcion");
        
            $table->float("valor")->default(100);
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Opcion")->on("reactivos__opciones")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Reactivo','ID_Opcion']);
     
        
        });
        Schema::create('reactivos__datos_extras', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->longText("Datos");
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Reactivo']);
        });
        Schema::create('reactivos__estadisticas', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_tipo");
            $table->unsignedBigInteger("ID_Grado");
            $table->float("valor")->default(100);
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_tipo")->on("reactivos__tipos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("tg__grados_academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("Numero_De_Preguntas")->default(0);
            $table->float("Suma_valor")->default(0);
            $table->float("Suma_tiempo")->default(0);
            $table->primary(['ID_Reactivo','ID_tipo','ID_Grado']);
        });
        Schema::create('reactivos__retroalimentacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Grado") ;
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("tg__grados_academicos")->references("id")->cascadeOnUpdate();
            $table->longText("Retroalimentacion")->nullable();
            $table->json("Datos")->nullable();
        });
        Schema::create('reactivos__popularidad', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("ID_Grado") ;
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grado")->on("tg__grados_academicos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->float("Valor")->default(0)->nullable();
            $table->float("Dificultad_Alumnos")->default(0)->nullable();
            $table->float("Dificultad_Creador")->default(0)->nullable();
            $table->float("Dificultad_Maestros")->default(0)->nullable();
            $table->json("Neuronas")->nullable();
            $table->primary(['ID_Reactivo','ID_Grado']);
        });     
        
        Schema::create('reactivos__listas_reactivo', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->unsignedBigInteger("ID_Creador")->nullable();
            $table->foreign("ID_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });    
            
        Schema::create('reactivos__listas_opciones' ,function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->unsignedBigInteger("ID_Creador")->nullable();
            $table->foreign("ID_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('reactivos__opciones_lista' ,function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Lista_opcion");
            $table->unsignedBigInteger("ID_opcion") ;
            $table->foreign("ID_Lista_opcion")->on("reactivos__listas_opciones")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_opcion")->on("reactivos__opciones")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Lista_opcion','ID_opcion']);
        });
        Schema::create('reactivos__reactivo_lista' ,function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Lista_Reactivo");
            $table->unsignedBigInteger("ID_Reactivo") ;
            $table->foreign("ID_Lista_Reactivo")->on("reactivos__listas_reactivo")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Lista_Reactivo','ID_Reactivo']);
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('reactivos__reactivo_lista');
        Schema::dropIfExists('reactivos__opciones_lista');
        Schema::dropIfExists('reactivos__listas_opciones');
        Schema::dropIfExists('reactivos__listas_reactivo');
        
        Schema::dropIfExists('reactivos__popularidad');
        Schema::dropIfExists('reactivos__retroalimentacion');
        Schema::dropIfExists('reactivos__estadisticas');
        Schema::dropIfExists('reactivos__datos_extras');
        Schema::dropIfExists('reactivos__reactivos_opciones');
        Schema::dropIfExists('reactivos__opciones');
        Schema::dropIfExists('reactivos__reactivos');
        Schema::dropIfExists('reactivos__tipos');
        Schema::dropIfExists('reactivos__grupos_tipos');
        Schema::dropIfExists('reactivos__temas_interest');
    }
}
