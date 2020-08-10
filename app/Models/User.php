<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 *  archivos necesario para autentificar
 */

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;



/**
 * Class User
 *
 * @property int $id
 * @property string|null $Nombre
 * @property string|null $Apellido
 * @property string|null $Grado_Academico
 * @property string|null $Ruta_Imagen
 * @property string|null $Nombre_de_Usuario
 * @property string|null $Telefono
 * @property Carbon|null $Fecha_Nacimiento
 * @property bool $Perfil_visible
 * @property bool $Recibir_Correos
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|ChatParticipante[] $chat__participantes
 * @property Collection|GuGrupo[] $gu__grupos
 * @property Collection|GuIntegrante[] $gu__integrantes
 * @property Collection|IaUsuario[] $ia__usuarios
 * @property Collection|InstitucionAlumno[] $institucion__alumnos
 * @property Collection|InstitucionInstitucion[] $institucion__institucions
 * @property Collection|InstitucionProfesore[] $institucion__profesores
 * @property Collection|MembresiasMembresium[] $membresias__membresia
 * @property Collection|MembresiasTiket[] $membresias__tikets
 * @property Collection|MembresiasUsuario[] $membresias__usuarios
 * @property Collection|PaginasLog[] $paginas__logs
 * @property Collection|PaginasPagina[] $paginas__paginas
 * @property Collection|PaginasSugerencia[] $paginas__sugerencias
 * @property PasswordReset $password_reset
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @property Collection|TestsAplicado[] $tests__aplicados
 * @property Collection|TestsGrupo[] $tests__grupos
 * @property Collection|TestsIntegrante[] $tests__integrantes
 * @property Collection|TestsListanegra[] $tests__listanegras
 * @property Collection|TestsTest[] $tests__tests
 * @property Collection|TestsUsuario[] $tests__usuarios
 * @property Collection|TgCurso[] $tg__cursos
 * @property Collection|TgGradosAcademico[] $tg__grados_academicos
 * @property Collection|TgTema[] $tg__temas
 * @property Collection|Permiso[] $permisos
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class User extends Model  implements AuthenticatableContract 
{
    
    use Authenticatable;
    public $incrementing = true;
    protected $table = 'users';

    protected $casts = [
        'Perfil_visible' => 'bool',
        'Recibir_Correos' => 'bool'
    ];

    protected $dates = [
        'Fecha_Nacimiento',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Grado_Academico',
        'Ruta_Imagen',
        'Nombre_de_Usuario',
        'Telefono',
        'Fecha_Nacimiento',
        'Perfil_visible',
        'Recibir_Correos',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    public function chat__participantes()
    {
        return $this->hasMany(ChatParticipante::class, 'ID_Participante');
    }

    public function gu__grupos()
    {
        return $this->hasMany(GuGrupo::class, 'ID_Usuario_Creador');
    }

    public function gu__integrantes()
    {
        return $this->hasMany(GuIntegrante::class, 'ID_User');
    }

    public function ia__usuarios()
    {
        return $this->hasMany(IaUsuario::class, 'ID_Usuario');
    }

    public function institucion__alumnos()
    {
        return $this->hasMany(InstitucionAlumno::class, 'ID_Alumno');
    }

    public function institucion__institucions()
    {
        return $this->hasMany(InstitucionInstitucion::class, 'ID_Responsable');
    }

    public function institucion__profesores()
    {
        return $this->hasMany(InstitucionProfesore::class, 'ID_profesor');
    }

    public function membresias__membresia()
    {
        return $this->hasMany(MembresiasMembresium::class, 'ID_Usuario');
    }

    public function membresias__tikets()
    {
        return $this->hasMany(MembresiasTiket::class, 'ID_Usuario_Acepta');
    }

    public function membresias__usuarios()
    {
        return $this->hasMany(MembresiasUsuario::class, 'ID_Usuario');
    }

    public function paginas__logs()
    {
        return $this->hasMany(PaginasLog::class, 'Real_ID_User');
    }

    public function paginas__paginas()
    {
        return $this->hasMany(PaginasPagina::class, 'ID_Usuario');
    }

    public function paginas__sugerencias()
    {
        return $this->hasMany(PaginasSugerencia::class, 'ID_Revisor');
    }

    public function password_reset()
    {
        return $this->hasOne(PasswordReset::class, 'email', 'email');
    }

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Creador');
    }

    public function tests__aplicados()
    {
        return $this->hasMany(TestsAplicado::class, 'ID_Integrante');
    }

    public function tests__grupos()
    {
        return $this->hasMany(TestsGrupo::class, 'ID_Administrador');
    }

    public function tests__integrantes()
    {
        return $this->hasMany(TestsIntegrante::class, 'ID_Usuario');
    }

    public function tests__listanegras()
    {
        return $this->hasMany(TestsListanegra::class, 'ID_Usuario');
    }

    public function tests__tests()
    {
        return $this->hasMany(TestsTest::class, 'ID_Usuario_Creador');
    }

    public function tests__usuarios()
    {
        return $this->hasMany(TestsUsuario::class, 'ID_Usuario');
    }

    public function tg__cursos()
    {
        return $this->hasMany(TgCurso::class, 'ID_Usuario_Creador');
    }

    public function tg__grados_academicos()
    {
        return $this->hasMany(TgGradosAcademico::class, 'ID_Usuario_Creador');
    }

    public function tg__temas()
    {
        return $this->hasMany(TgTema::class, 'ID_Usuario_Creador');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'users_permisos', 'ID_Usuario', 'ID_Permiso');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'ID_Usuario', 'ID_Role');
    }
}
