<?php

use Illuminate\Database\Seeder;
use App\Models\User;


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
    }
}        
