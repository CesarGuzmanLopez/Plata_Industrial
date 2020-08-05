<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat__conversaciones', function (Blueprint $table) {
            $table->id();
            $table->boolean("Privado");
            $table->boolean("Directo");
            $table->multiLineString("Data");
            $table->timestamps();
        });
        Schema::create('chat__mensajes', function (Blueprint $table) {
            $table->id();
            $table->multiLineString("body");
            $table->unsignedBigInteger("ID_Conversacion");
            $table->boolean("Grupal")->default(false);
            $table->timestamps();
            $table->foreign("ID_Conversacion")->references("id")->on("chat__conversaciones")->cascadeOnDelete();
        });
        Schema::create('chat__participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("ID_Conversacion");
            $table->string("Tipo_Mensaje")->comment("Si es multimedia o texto u otros");
            $table->text("Configuracion")->comment("Guardar el nombre de los integrantes para que se conserve en caso de eliminar el usuario");
            $table->unsignedBigInteger("ID_Participante")->nullable();           
            $table->foreign("ID_Conversacion")->references("id")->on("chat__conversaciones")->cascadeOnDelete();
            $table->foreign("ID_Participante")->references("id")->on("users")->nullOnDelete();
           
        });
            Schema::create('chat__Notificaciones', function (Blueprint $table) {
                
                $table->id();
                $table->unsignedBigInteger("ID_Mensaje");
                $table->unsignedBigInteger("ID_Conversacion");
                $table->unsignedBigInteger("ID_Participante");
                
                $table->boolean("visto")->default(false);
                $table->boolean("enviado")->default(false);
                $table->boolean("recibido")->default(false);
                $table->timestamps();
         
                
                $table->foreign("ID_Mensaje")->references("id")->on("chat__mensajes")->cascadeOnDelete();
                $table->foreign("ID_Conversacion")->references("id")->on("chat__conversaciones")->cascadeOnDelete();
                $table->foreign("ID_Participante")->references("id")->on("chat__participantes")->cascadeOnDelete();
                
            });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::dropIfExists('chat__Notificaciones');
        Schema::dropIfExists('chat__participantes');
        Schema::dropIfExists('chat__mensajes');
        Schema::dropIfExists('chat__conversaciones');
        
    }
}
