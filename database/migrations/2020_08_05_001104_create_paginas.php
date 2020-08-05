<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaginas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paginas__paginas', function (Blueprint $table) {
            $table->id();
            $table->string("Descripcion")->nullable();
            $table->integer("Tipo_Pagina")->description('El tipo de pagina que es si es 1.json 2.php 3.blog,... etc,')->nullable();
            $table->unsignedBigInteger("ID_Usuario")->nullable();
            $table->string("TipoTexto")->nullable();
            $table->string("Url_Relativa")->nullable();
            $table->multiLineString("Data");
            $table->string("Ruta")->nullable()->default("");
            $table->boolean("Activa")->default(false);
            $table->multiLineString("meta_Description")->nullable();
            $table->lineString("meta_Keywords")->nullable();
            $table->unsignedBigInteger("ID_Rol_Permitido")->nullable();
            $table->timestamps();
            $table->foreign('ID_Usuario')->references('id')->on('users')->nullOnDelete();
            $table->foreign('ID_Rol_Permitido')->references('id')->on('roles')->nullOnDelete();
        });
        Schema::create('paginas__sugerencias', function (Blueprint $table) {
            $table->id();
            $table->string("Sugerencia");
            $table->unsignedBigInteger("ID_Autor")->nullable();
            $table->unsignedBigInteger("ID_Revisor")->nullable();
            $table->boolean("Estado")->default(false);
            $table->multiLineString("meta_Description")->nullable();
            $table->lineString("meta_Keywords")->nullable();
            $table->foreign('ID_Autor')->references('id')->on('users')->nullOnDelete();
            $table->foreign('ID_Revisor')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
        
        Schema::create('paginas__logs', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre_Evento");
            $table->string("Componente");
            $table->string("Accion");
            $table->string("Target");
            $table->unsignedBigInteger("ID_Pagina");
            $table->unsignedBigInteger("ID_Usuario")->nullable();
            $table->string("IP")->nullable();
            $table->unsignedBigInteger("Real_ID_User")->nullable();
            $table->foreign('ID_Usuario')->references('id')->on('users')->nullOnDelete();
            $table->foreign('Real_ID_User')->references('id')->on('users')->nullOnDelete();
            $table->foreign('ID_Pagina')->references('id')->on('paginas__paginas')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('paginas__menu', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre");
            $table->timestamps();
        });
        Schema::create('paginas__menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Menu");
            $table->string("Titulo");
            $table->string("url");
            $table->string("target")->default("_self");
            $table->string("Icono_clase")->default("");
            $table->string("tipo");
            $table->integer("Order");
            $table->unsignedBigInteger("ID_Item_Padre");
            $table->string("parametros")->nullable();
            $table->unsignedBigInteger("ID_Pagina")->nullable();
            $table->boolean("Activo")->default(true);
            $table->timestamps();
            $table->foreign('ID_Menu')->references('id')->on('paginas__menu')->onDelete('cascade');
            $table->foreign('ID_Item_Padre')->references('id')->on('paginas__menu_items')->onDelete('cascade');
            $table->foreign('ID_Pagina')->references('id')->on('paginas__paginas')->onDelete('cascade');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paginas__menu_items');
        Schema::dropIfExists('paginas__menu');        
        Schema::dropIfExists('paginas__logs');
        Schema::dropIfExists('paginas__sugerencias');
        Schema::dropIfExists('paginas__paginas');
    }
}
