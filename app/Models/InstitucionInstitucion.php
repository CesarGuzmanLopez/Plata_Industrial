<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionInstitucion
 *
 * @property int $id
 * @property string $Nombre_institucion
 * @property int $ID_Responsable
 * @property int|null $ID_Responsable2
 * @property int|null $ID_Membrecia
 * @property int $Numero_docentes_maximos
 * @property int $Numero_grupos_maximos
 * @property int $Numero_alumnos_por_curso
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property MembresiasMembresium $membresias_membresium
 * @property User $user
 * @property Collection|InstitucionAlumno[] $institucion__alumnos
 * @property Collection|InstitucionGrupo[] $institucion__grupos
 * @property Collection|InstitucionProfesore[] $institucion__profesores
 *
 * @package App\Models
 */
class InstitucionInstitucion extends Model
{

    protected $table = 'institucion__institucion';

    protected $casts = [
        'ID_Responsable' => 'int',
        'ID_Responsable2' => 'int',
        'ID_Membrecia' => 'int',
        'Numero_docentes_maximos' => 'int',
        'Numero_grupos_maximos' => 'int',
        'Numero_alumnos_por_curso' => 'int'
    ];

    protected $fillable = [
        'Nombre_institucion',
        'ID_Responsable',
        'ID_Responsable2',
        'ID_Membrecia',
        'Numero_docentes_maximos',
        'Numero_grupos_maximos',
        'Numero_alumnos_por_curso'
    ];

    public function membresias_membresium()
    {
        return $this->belongsTo(MembresiasMembresium::class, 'ID_Membrecia');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Responsable');
    }

    public function institucion__alumnos()
    {
        return $this->hasMany(InstitucionAlumno::class, 'ID_institucion');
    }

    public function institucion__grupos()
    {
        return $this->hasMany(InstitucionGrupo::class, 'ID_Institucion');
    }

    public function institucion__profesores()
    {
        return $this->hasMany(InstitucionProfesore::class, 'ID_institucion');
    }
}
