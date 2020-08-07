<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionGrupoAlumno
 *
 * @property int $ID_Grupo
 * @property int $ID_Alumno
 * @property int $Numero_lista
 * @property bool $Activo
 *
 * @property InstitucionAlumno $institucion_alumno
 * @property InstitucionGrupo $institucion_grupo
 *
 * @package App\Models
 */
class InstitucionGrupoAlumno extends Model
{

    protected $table = 'institucion__grupo_alumnos';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Grupo' => 'int',
        'ID_Alumno' => 'int',
        'Numero_lista' => 'int',
        'Activo' => 'bool'
    ];

    protected $fillable = [
        'Numero_lista',
        'Activo'
    ];

    public function institucion_alumno()
    {
        return $this->belongsTo(InstitucionAlumno::class, 'ID_Alumno');
    }

    public function institucion_grupo()
    {
        return $this->belongsTo(InstitucionGrupo::class, 'ID_Grupo');
    }
}
