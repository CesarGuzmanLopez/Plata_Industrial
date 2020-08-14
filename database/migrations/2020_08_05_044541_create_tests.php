<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests__test', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("Tipo_Text")->comment("0:examen, 1:Tareas, 2:Entrenamiento")->default(2);
            $table->unsignedBigInteger("ID_Grado_Academico")->nullable();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->string("Descripcion");
            $table->dateTime("Fecha_inicio");
            $table->dateTime("Fecha_final");
            $table->float("Dificultad_Absoluta")->nullable()->default(0);
            $table->float("Umbral")->default(0)->nullable();            
            $table->boolean("Examen_Unico")->default(false)->nullable();
            $table->boolean("Examen_Aleatorio")->default(true)->nullable();
            $table->unsignedInteger("Duracion")->default(null)->nullable();
            $table->foreign("ID_Grado_Academico")->on("tg__grados_academicos")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('tests__reactivos', function (Blueprint $table) {
            $table->id();
            $table->integer("numero");
            $table->unsignedBigInteger("ID_Test");
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("tipo")->nullable();
            $table->foreign("ID_Test")->on("tests__test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreign("ID_Reactivo")->on("reactivos__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('tests__generados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Test");
            $table->foreign("ID_Test")->on("tests__test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();;
            $table->json("DatosGenerados");
            $table->timestamps();
        });
        Schema::create('tests__reactivo_generado', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Test_Generado");
            $table->unsignedBigInteger("ID_Reactivo");
            $table->json("Data_1")->nullable();
            $table->json("Data_2")->nullable();
            $table->foreign("ID_Reactivo")->on("tests__reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Test_Generado")->on("tests__generados")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Test_Generado','ID_Reactivo']);
            $table->timestamps();
        });
        Schema::create('tests__grupo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Administrador")->nullable();
            $table->multiLineString("Descripcion")->nullable();
            $table->foreign("ID_Administrador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();           
            $table->timestamps();
        });
        Schema::create('tests__usuario', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Test");
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Test")->on("tests__test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Usuario','ID_Test']);
            $table->string("Descripcion")->nullable();
            $table->integer("intentos")->default(1)->comment("Numero de intentos que tendra el usuario");
            $table->timestamps();
        });
        Schema::create('tests__integrantes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Grupo");
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grupo")->on("tests__grupo")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Usuario','ID_Grupo']);
        });
        Schema::create('tests__aplicado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Integrante");
            $table->unsignedBigInteger("ID_Grupo")->nullable();
            $table->unsignedBigInteger("ID_Generado");
            
            $table->foreign("ID_Generado")->on("tests__generados")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Integrante")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grupo")->on("tests__grupo")->references("id")->nullOnDelete()->cascadeOnUpdate();
            
            $table->dateTime("Aplicado");
            $table->unsignedBigInteger("Tiempo")->comment("Tiempo llevado en segundos");
            $table->integer("intento")->default(0);
            $table->string("Comentarios")->nullable();
            $table->unsignedBigInteger("ID_Test")->nullable();
            $table->foreign("ID_Test")->on("tests__test")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
        
        Schema::create('tests__respuesta', function (Blueprint $table) {
              $table->unsignedBigInteger("ID_Test_hecho");
              $table->unsignedBigInteger("ID_Respuesta");
              $table->json("Data1")->nullable();  
              $table->json("Data2")->nullable();
              $table->foreign("ID_Test_hecho")->on("tests__aplicado")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
              $table->foreign("ID_Respuesta")->on("reactivos__opciones")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
              $table->primary(['ID_Test_hecho','ID_Respuesta']);
        });
        Schema::create('tests__listanegra', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Test");
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Test")->on("tests__test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Usuario','ID_Test']);
            $table->json("Datos");        
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests__listanegra');
        Schema::dropIfExists('tests__respuesta');
        Schema::dropIfExists('tests__aplicado');
        Schema::dropIfExists('tests__integrantes');
        Schema::dropIfExists('tests__usuario');
        Schema::dropIfExists('tests__grupo');
        Schema::dropIfExists('tests__reactivo_generado');
        Schema::dropIfExists('tests__generados');
        Schema::dropIfExists('tests__reactivos');
        Schema::dropIfExists('tests__test');
    }
}
