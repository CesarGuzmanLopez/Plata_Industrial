<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsGrupo
 *
 * @property int $id
 * @property int|null $ID_Administrador
 * @property multilinestring|null $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|TestsAplicado[] $tests__aplicados
 * @property Collection|TestsIntegrante[] $tests__integrantes
 *
 * @package App\Models
 */
class TestsGrupo extends Model
{

    protected $table = 'tests__grupo';

    protected $casts = [
        'ID_Administrador' => 'int',
        'Descripcion' => 'multilinestring'
    ];

    protected $fillable = [
        'ID_Administrador',
        'Descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Administrador');
    }

    public function tests__aplicados()
    {
        return $this->hasMany(TestsAplicado::class, 'ID_Grupo');
    }

    public function tests__integrantes()
    {
        return $this->hasMany(TestsIntegrante::class, 'ID_Grupo');
    }
}
