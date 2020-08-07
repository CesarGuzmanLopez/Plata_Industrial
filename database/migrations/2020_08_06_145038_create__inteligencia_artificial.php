<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteligenciaArtificial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IA__Usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_GradoAcademico")->nullable();
            $table->unsignedBigInteger("ID_Usuario");
            $table->json("Red_Neuronal");
            $table->foreign("ID_GradoAcademico")->on("TG__Grados_Academicos")->references("id")->nullOnDelete();
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('IA__Temas_interes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->unsignedBigInteger("ID_Tema_Interes");
            $table->foreign("ID_IA")->on("IA__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Interes")->on("Reactivos__Temas_Interest")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["ID_IA","ID_Tema_Interes"]);
            $table->timestamps();
        });
        Schema::create('IA__Busquedas', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->string("Busqueda");
            $table->integer("Contador")->comment("Numero de busquedas");
            $table->foreign("ID_IA")->on("IA__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('IA__Temas_Revisados', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->foreign("ID_IA")->on("IA__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("ID_Tema_Visto");
            $table->foreign("ID_Tema_Visto")->on("TG__Temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["ID_IA","ID_Tema_Visto"]);
            $table->json("Data");
            $table->float("Calificacion");
            $table->integer("NumeroPreguntas");
            $table->integer("Tiempo_dedicado_en_preguntas");
            $table->integer("Tiempo_dedicado_en_material");
            $table->timestamps();
        });
        Schema::create('IA__Temas_Recomendados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_IA");
            $table->unsignedBigInteger("ID_Tema_Recomendado");
            $table->foreign("ID_IA")->on("IA__Usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Recomendado")->on("TG__Temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('IA__Temas_Recomendados');
        Schema::dropIfExists('IA__Temas_Revisados');
        Schema::dropIfExists('IA__Busquedas');
        Schema::dropIfExists('IA__Temas_interes');
        Schema::dropIfExists('IA__Usuario');
    }
}
