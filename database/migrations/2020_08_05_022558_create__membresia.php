<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresia extends Migration
{
    /**
     * Run the migrations.
     *  La palabra debe ser "Membresía"
     * @return void
     */
    public function up()
    {
        Schema::create('membresias__membresia', function (Blueprint $table) {
            $table->id();
            $table->float("Costo");
            $table->time("Duracion");
            $table->dateTime("Inicio_disponibilidad");
            $table->dateTime("fin_disponibilidad");
            $table->unsignedBigInteger("ID_rol_a_recibir");
            $table->unsignedBigInteger("ID_rol_necesario")->nullable();
            $table->unsignedBigInteger("ID_rol_incompatible")->nullable();
            $table->boolean(true);
            $table->unsignedBigInteger("ID_Usuario")->nullable();
            $table->timestamps();
            
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->foreign("ID_rol_a_recibir")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_rol_necesario")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_rol_incompatible")->on("roles")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            
        });
            Schema::create('membresias__Tiket', function (Blueprint $table) {
                $table->id();
                $table->string("Pago");
                $table->string("llave")->unique();
                $table->unsignedBigInteger("ID_Usuario_Acepta")->nullable();
                $table->timestamps();
                $table->foreign("ID_Usuario_Acepta")->on("users")->references("id")->nullOnDelete()->cascadeOnUpdate();
                
                
            });
        
        Schema::create('membresias__usuario', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Usuario");
            $table->unsignedBigInteger("ID_Membrecia");
            $table->string("Numero_Membrecia")->unique();
            $table->dateTime("Inicio");
            $table->date("Fin");
            $table->unsignedBigInteger("ID_tiket")->nullable();
            $table->timestamps();
            
            $table->foreign("ID_Usuario")->on("users")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Membrecia")->on("membresias__membresia")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->primary(['ID_Usuario','ID_Membrecia']);
            $table->foreign("ID_tiket")->on("membresias__Tiket")->references("id")->nullOnDelete()->cascadeOnUpdate();   
        });
        Schema::create('membresias__grupo', function (Blueprint $table) {
            $table->unsignedBigInteger("ID_Grupo");
            $table->unsignedBigInteger("ID_Membrecia");
            $table->string("Numero_Membrecia")->unique();
            $table->dateTime("Inicio");
            $table->date("Fin");
            $table->unsignedBigInteger("ID_tiket")->nullable();
            $table->timestamps();
            $table->foreign("ID_Grupo")->on("gu__grupos")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("ID_Membrecia")->on("membresias__membresia")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['ID_Grupo','ID_Membrecia']);
            $table->foreign("ID_tiket")->on("membresias__Tiket")->references("id")->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membresias__usuario');
        Schema::dropIfExists('membresias__grupo');
        Schema::dropIfExists('membresias__Tiket');
        Schema::dropIfExists('membresias__membresia');
    }
    
}
