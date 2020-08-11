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
        Schema::create('ia__usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_GradoAcademico")->nullable();
            $table->unsignedBigInteger("ID_Usuario");
            $table->json("Red_Neuronal");
            $table->foreign("ID_GradoAcademico")->on("tg__grados_academicos")->references("id")->nullOnDelete();
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('ia__temas_interes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->unsignedBigInteger("ID_Tema_Interes");
            $table->foreign("ID_IA")->on("ia__usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Interes")->on("reactivos__temas_interest")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["ID_IA","ID_Tema_Interes"]);
            $table->timestamps();
        });
        Schema::create('ia__busquedas', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->string("Busqueda");
            $table->integer("Contador")->comment("Numero de busquedas");
            $table->foreign("ID_IA")->on("ia__usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('ia__temas_revisados', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_IA");
            $table->foreign("ID_IA")->on("ia__usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger("ID_Tema_Visto");
            $table->foreign("ID_Tema_Visto")->on("tg__temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["ID_IA","ID_Tema_Visto"]);
            $table->json("Data");
            $table->float("Calificacion");
            $table->integer("NumeroPreguntas");
            $table->integer("Tiempo_dedicado_en_preguntas");
            $table->integer("Tiempo_dedicado_en_material");
            $table->timestamps();
        });
        Schema::create('ia__temas_recomendados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_IA");
            $table->unsignedBigInteger("ID_Tema_Recomendado");
            $table->foreign("ID_IA")->on("ia__usuario")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Tema_Recomendado")->on("tg__temas")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('ia__temas_recomendados');
        Schema::dropIfExists('ia__temas_revisados');
        Schema::dropIfExists('ia__busquedas');
        Schema::dropIfExists('ia__temas_interes');
        Schema::dropIfExists('ia__usuario');
    }
}
