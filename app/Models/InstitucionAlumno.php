<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionAlumno
 *
 * @property int $id
 * @property int $ID_Alumno
 * @property int $ID_institucion
 * @property string|null $Grado_Estudio
 * @property string|null $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property InstitucionInstitucion $institucion_institucion
 * @property Collection|InstitucionGrupoAlumno[] $institucion__grupo_alumnos
 *
 * @package App\Models
 */
class InstitucionAlumno extends Model
{

    protected $table = 'institucion__alumnos';

    protected $casts = [
        'ID_Alumno' => 'int',
        'ID_institucion' => 'int'
    ];

    protected $fillable = [
        'ID_Alumno',
        'ID_institucion',
        'Grado_Estudio',
        'Descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Alumno');
    }

    public function institucion_institucion()
    {
        return $this->belongsTo(InstitucionInstitucion::class, 'ID_institucion');
    }

    public function institucion__grupo_alumnos()
    {
        return $this->hasMany(InstitucionGrupoAlumno::class, 'ID_Alumno');
    }
}
