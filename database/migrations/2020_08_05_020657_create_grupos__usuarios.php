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
        Schema::create('gu__tipo', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre");
            
        });
        Schema::create('gu__grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Tipo_Grupo")->nullable();
            $table->unsignedBigInteger("ID_Usuario_Creador")->nullable();
            $table->timestamps();
            $table->foreign("ID_Usuario_Creador")->on("users")->references("id")->nullOnDelete();
            $table->foreign("Tipo_Grupo")->on("gu__tipo")->references("id")->nullOnDelete();
        });
        Schema::create('gu_integrantes', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_User");
            $table->unsignedBigInteger("ID_grupo");
            $table->bigInteger("posicion")->default(0)->nullable();
            $table->timestamps();
            $table->foreign("ID_User")->on("users")->references("id")->cascadeOnDelete();
            $table->foreign("ID_grupo")->on("gu__grupos")->references("id")->cascadeOnDelete();
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
        Schema::dropIfExists('gu_integrantes');
        Schema::dropIfExists('gu__grupos');
        Schema::dropIfExists('gu__tipo');
    }
}
