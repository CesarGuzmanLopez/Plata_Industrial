// <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Exepciones en traduccion 
     * user, email, password,token.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre')->nullable();
            $table->string('Apellido')->nullable();
            $table->string('Grado_Academico')->nullable();
            $table->string('Ruta_Imagen')->nullable();
            $table->string('Nombre_de_Usuario')->unique()->nullable()->comment("Este usuario no debe ser repetido");
            $table->string('Telefono')->nullable()->comment("");
            $table->date('Fecha_Nacimiento')->nullable();
            $table->boolean('Perfil_visible')->default(false);
            $table->boolean('Recibir_Correos')->default(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index()->primary();
            $table->string('token');
            $table->timestamps();
            $table->foreign('email')
            ->references('email')->on('users')
            ->cascadeOnDelete();
        }); 
    }
    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
}
