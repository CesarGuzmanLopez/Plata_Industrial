<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 *
 * @property int $id
 * @property string|null $Nombre
 * @property string $Slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Role[] $roles
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Permiso extends Model
{

    protected $table = 'permisos';

    protected $fillable = [
        'Nombre',
        'Slug'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permisos', 'ID_Permiso', 'ID_Role')->withPivot('Verificado');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permisos', 'ID_Permiso', 'ID_Usuario');
    }
}
