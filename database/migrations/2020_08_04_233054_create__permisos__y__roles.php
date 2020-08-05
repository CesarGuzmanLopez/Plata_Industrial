<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosYRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique()->nullable();
            $table->string("Slug")->unique()->comment("Nombre en formato para la programación");
            $table->timestamps();
        });
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre")->unique()->nullable();
            $table->string("Slug")->unique()->comment("Nombre en formato para la programación");
            $table->timestamps();
        });
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Role');
            $table->unsignedBigInteger('ID_Permiso');
            $table->boolean("Verificado")->default(false);
            $table->foreign('ID_Role')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('ID_Permiso')->references('id')->on('permisos')->onDelete('cascade');
            $table->primary(['ID_Role','ID_Permiso']);
        });
        Schema::create('users_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Role');
            $table->unsignedBigInteger('ID_Usuario');
            $table->foreign('ID_Role')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('ID_Usuario')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['ID_Role','ID_Usuario']);
        });
        Schema::create('users_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Permiso');
            $table->unsignedBigInteger('ID_Usuario');
            $table->foreign('ID_Permiso')->references('id')->on('permisos')->onDelete('cascade');
            $table->foreign('ID_Usuario')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['ID_Permiso','ID_Usuario']);
        });
        
        
    }

    /**
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_permisos');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('roles_permisos');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('roles');
    }
}
