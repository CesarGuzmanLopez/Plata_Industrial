<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitucionProfesore
 *
 * @property int $id
 * @property int $ID_profesor
 * @property int $ID_institucion
 * @property string|null $Grado_Estudio
 * @property string|null $Descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property InstitucionInstitucion $institucion_institucion
 * @property User $user
 * @property Collection|InstitucionGrupo[] $institucion__grupos
 *
 * @package App\Models
 */
class InstitucionProfesore extends Model
{

    protected $table = 'institucion__profesores';

    protected $casts = [
        'ID_profesor' => 'int',
        'ID_institucion' => 'int'
    ];

    protected $fillable = [
        'ID_profesor',
        'ID_institucion',
        'Grado_Estudio',
        'Descripcion'
    ];

    public function institucion_institucion()
    {
        return $this->belongsTo(InstitucionInstitucion::class, 'ID_institucion');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_profesor');
    }

    public function institucion__grupos()
    {
        return $this->hasMany(InstitucionGrupo::class, 'ID_Profesor');
    }
}
