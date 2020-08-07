<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TgGradosAcademico
 *
 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Usuario_Creador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|IaUsuario[] $ia__usuarios
 * @property Collection|ReactivosEstadistica[] $reactivos__estadisticas
 * @property Collection|ReactivosPopularidad[] $reactivos__popularidads
 * @property Collection|ReactivosRetroalimentacion[] $reactivos__retroalimentacions
 * @property Collection|TestsTest[] $tests__tests
 * @property Collection|TgGradoCursosDifuso[] $tg__grado_cursos_difusos
 *
 * @package App\Models
 */
class TgGradosAcademico extends Model
{

    protected $table = 'tg__grados_academicos';

    protected $casts = [
        'ID_Usuario_Creador' => 'int'
    ];

    protected $fillable = [
        'Nombre',
        'ID_Usuario_Creador'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function ia__usuarios()
    {
        return $this->hasMany(IaUsuario::class, 'ID_GradoAcademico');
    }

    public function reactivos__estadisticas()
    {
        return $this->hasMany(ReactivosEstadistica::class, 'ID_Grado');
    }

    public function reactivos__popularidads()
    {
        return $this->hasMany(ReactivosPopularidad::class, 'ID_Grado');
    }

    public function reactivos__retroalimentacions()
    {
        return $this->hasMany(ReactivosRetroalimentacion::class, 'ID_Grado');
    }

    public function tests__tests()
    {
        return $this->hasMany(TestsTest::class, 'ID_Grado_Academico');
    }

    public function tg__grado_cursos_difusos()
    {
        return $this->hasMany(TgGradoCursosDifuso::class, 'ID_Grado');
    }
}
