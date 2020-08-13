<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ReactivosGruposTipo;
use App\Models\ReactivosTipo;


class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $user0 = new User();
        $user0->Nombre = 'Cesar';
        $user0->email = 'admin@admin.com';
        $user0->Nombre_de_Usuario="Cesar_G";
        $user0->password = bcrypt('password');
        $user0->save();
        
        $user0 = new User();
        $user0->Nombre = 'Eduardo Gabriel';
        $user0->Apellido='Guzman Lopez';
        $user0->email = 'admin2@admin.com';
        $user0->password = bcrypt('password');
        $user0->save();
        
        $user0 = new User();
        $user0->Nombre = 'Miguel';
        $user0->email = 'admin3@admin.com';
        $user0->password = bcrypt('password');
        $user0->save();
        $user0 = new User();
        $user0->Nombre = 'Antonio';
        $user0->email = 'admin4@admin.com';
        $user0->password = bcrypt('password');
        $user0->save();
        
        
        $Tipos = new ReactivosGruposTipo();
        $Tipos->Nombre = "Opciones multiples";
        $Tipos->Descripcion="Preguntas que pueden tener única opción u opciones múltiples";

        $Tipos->save();
        
        $Tipo = new ReactivosTipo();
        $Tipo->Nombre_Tipo= "Opcion unica";
        $Tipo->Activo = true;
        $Tipo->Datos=json_encode(" ");
        $Tipo->ID_Grupo = 1;

        $Tipo->save();
    
        $Tipo = new ReactivosTipo();
        $Tipo->Nombre_Tipo= "Opciones Multiple";
        $Tipo->Activo = true;
        $Tipo->Datos=json_encode(" ");
        $Tipo->ID_Grupo = 1;
        $Tipo->save();

        
    }
}        
