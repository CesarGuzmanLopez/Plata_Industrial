<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolesPermiso
 *
 * @property int $ID_Role
 * @property int $ID_Permiso
 * @property bool $Verificado
 *
 * @property Permiso $permiso
 * @property Role $role
 *
 * @package App\Models
 */
class RolesPermiso extends Model
{

    protected $table = 'roles_permisos';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Role' => 'int',
        'ID_Permiso' => 'int',
        'Verificado' => 'bool'
    ];

    protected $fillable = [
        'Verificado'
    ];

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'ID_Permiso');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'ID_Role');
    }
}
