<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TgCurso
 *
 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Usuario_Creador
 * @property bool $Premium
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|InstitucionGrupo[] $institucion__grupos
 * @property Collection|TgCursoTemasDifuso[] $tg__curso_temas_difusos
 * @property Collection|TgGradoCursosDifuso[] $tg__grado_cursos_difusos
 *
 * @package App\Models
 */
class TgCurso extends Model
{

    protected $table = 'tg__curso';

    protected $casts = [
        'ID_Usuario_Creador' => 'int',
        'Premium' => 'bool'
    ];

    protected $fillable = [
        'Nombre',
        'ID_Usuario_Creador',
        'Premium'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function institucion__grupos()
    {
        return $this->hasMany(InstitucionGrupo::class, 'ID_Curso');
    }

    public function tg__curso_temas_difusos()
    {
        return $this->hasMany(TgCursoTemasDifuso::class, 'ID_Curso');
    }

    public function tg__grado_cursos_difusos()
    {
        return $this->hasMany(TgGradoCursosDifuso::class, 'ID_Curso');
    }
}
