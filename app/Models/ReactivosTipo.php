<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosTipo
 *
 * @property int $id
 * @property int|null $ID_Grupo
 * @property string $Nombre_Tipo
 * @property string $Ruta
 * @property string $Datos
 * @property bool $Activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ReactivosGruposTipo $reactivos_grupos_tipo
 * @property Collection|ReactivosEstadistica[] $reactivos__estadisticas
 *
 * @package App\Models
 */
class ReactivosTipo extends Model
{

    protected $table = 'reactivos__tipos';

    protected $casts = [
        'ID_Grupo' => 'int',
        'Activo' => 'bool'
    ];

    protected $fillable = [
        'ID_Grupo',
        'Nombre_Tipo',
        'Ruta',
        'Datos',
        'Activo'
    ];

    public function reactivos_grupos_tipo()
    {
        return $this->belongsTo(ReactivosGruposTipo::class, 'ID_Grupo');
    }

    public function reactivos__estadisticas()
    {
        return $this->hasMany(ReactivosEstadistica::class, 'ID_tipo');
    }
}
