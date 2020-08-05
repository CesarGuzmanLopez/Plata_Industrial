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
        Schema::create('Tests__Test', function (Blueprint $table) {
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
            $table->foreign("ID_Grado_Academico")->on("TG__Grados_Academicos")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('Tests__Reactivos', function (Blueprint $table) {
            $table->id();
            $table->integer("numero");
            $table->unsignedBigInteger("ID_Test");
            $table->unsignedBigInteger("ID_Reactivo");
            $table->unsignedBigInteger("tipo")->nullable();
            $table->foreign("ID_Test")->on("Tests_Test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreign("ID_Reactivo")->on("Reactivos__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('Tests__Generados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Test");
            $table->foreign("ID_Test")->on("Tests_Test")->references("id")->cascadeOnDelete()->cascadeOnUpdate();;
            $table->timestamps();
        });
        Schema::create('Tests__Reactivos_Generados', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Test_Generado");
            $table->unsignedBigInteger("ID_Reactivo");
            $table->json("Data_1")->nullable();
            $table->json("Data_2")->nullable();
            $table->foreign("ID_Reactivo")->on("Tests__Reactivos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Test_Generado")->on("Tests__Generados")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Test_Generado','ID_Reactivo']);
            $table->timestamps();
        });
        Schema::create('Tests__Grupo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Administrador")->nullable();
            $table->multiLineString("Descripcion")->nullable();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();           
            $table->timestamps();
        });
        Schema::create('Tests__Usuario', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Generado");
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Generado")->on("Tests__Generados")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Usuario','Tests__Generados']);
            $table->string("Descripcion")->nullable();
            $table->integer("intentos")->default(0);
            $table->timestamps();
        });
        Schema::create('Tests__Integrantes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Generado");
            $table->unsignedBigInteger("ID_Grupo");
            $table->foreign("ID_Usuario")->on("Tests__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Grupo")->on("Tests__Grupo")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Generado")->on("Tests__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Usuario','Tests__Generados','Tests__Grupo']);

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
        Schema::dropIfExists('tests');
    }
}
