<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GU__Tipo', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre");
        });
        Schema::create('GU__Grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Tipo_Grupo")->nullable();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete();
            $table->foreign("Tipo_Grupo")->on("GU__Tipo")->references("id")->nullOnDelete();
        });
        Schema::create('GU__Integrantes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_User");
            $table->unsignedBigInteger("ID_grupo");
            $table->bigInteger("posicion")->default(0)->nullable();
            $table->timestamps();
            $table->foreign("ID_User")->on("users")->references("id")->cascadeOnDelete();
            $table->foreign("ID_grupo")->on("GU__Grupos")->references("id")->cascadeOnDelete();
            $table->primary(['ID_User','ID_grupo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GU__Integrantes');
        Schema::dropIfExists('GU__Grupos');
        Schema::dropIfExists('GU__Tipo');
    }
}
