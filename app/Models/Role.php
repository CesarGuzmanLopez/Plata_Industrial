<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property int $id
 * @property string|null $Nombre
 * @property string $Slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|MembresiasMembresium[] $membresias__membresia
 * @property Collection|PaginasPagina[] $paginas__paginas
 * @property Collection|Permiso[] $permisos
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{

    protected $table = 'roles';

    protected $fillable = [
        'Nombre',
        'Slug'
    ];

    public function membresias__membresia()
    {
        return $this->hasMany(MembresiasMembresium::class, 'ID_rol_necesario');
    }

    public function paginas__paginas()
    {
        return $this->hasMany(PaginasPagina::class, 'ID_Rol_Permitido');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'roles_permisos', 'ID_Role', 'ID_Permiso')->withPivot('Verificado');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles', 'ID_Role', 'ID_Usuario');
    }
}
