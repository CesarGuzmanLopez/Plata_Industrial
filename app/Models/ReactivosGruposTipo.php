<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosGruposTipo
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @property Collection|ReactivosTipo[] $reactivos__tipos
 *
 * @package App\Models
 */
class ReactivosGruposTipo extends Model
{

    protected $table = 'reactivos__grupos_tipos';

    protected $fillable = [
        'Nombre',
        'Descripcion'
    ];

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Grupo_Reactivos');
    }

    public function reactivos__tipos()
    {
        return $this->hasMany(ReactivosTipo::class, 'ID_Grupo');
    }
}
