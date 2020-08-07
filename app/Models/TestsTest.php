<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsTest
 *
 * @property int $id
 * @property int $Tipo_Text
 * @property int|null $ID_Grado_Academico
 * @property int|null $ID_Usuario_Creador
 * @property string $Descripcion
 * @property Carbon $Fecha_inicio
 * @property Carbon $Fecha_final
 * @property float|null $Dificultad_Absoluta
 * @property float|null $Umbral
 * @property bool|null $Examen_Unico
 * @property bool|null $Examen_Aleatorio
 * @property int|null $Duracion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TgGradosAcademico $tg_grados_academico
 * @property User $user
 * @property Collection|TestsAplicado[] $tests__aplicados
 * @property Collection|TestsGenerado[] $tests__generados
 * @property Collection|TestsListanegra[] $tests__listanegras
 * @property Collection|TestsReactivo[] $tests__reactivos
 * @property Collection|TestsUsuario[] $tests__usuarios
 *
 * @package App\Models
 */
class TestsTest extends Model
{

    protected $table = 'tests__test';

    protected $casts = [
        'Tipo_Text' => 'int',
        'ID_Grado_Academico' => 'int',
        'ID_Usuario_Creador' => 'int',
        'Dificultad_Absoluta' => 'float',
        'Umbral' => 'float',
        'Examen_Unico' => 'bool',
        'Examen_Aleatorio' => 'bool',
        'Duracion' => 'int'
    ];

    protected $dates = [
        'Fecha_inicio',
        'Fecha_final'
    ];

    protected $fillable = [
        'Tipo_Text',
        'ID_Grado_Academico',
        'ID_Usuario_Creador',
        'Descripcion',
        'Fecha_inicio',
        'Fecha_final',
        'Dificultad_Absoluta',
        'Umbral',
        'Examen_Unico',
        'Examen_Aleatorio',
        'Duracion'
    ];

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_Grado_Academico');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function tests__aplicados()
    {
        return $this->hasMany(TestsAplicado::class, 'ID_Test');
    }

    public function tests__generados()
    {
        return $this->hasMany(TestsGenerado::class, 'ID_Test');
    }

    public function tests__listanegras()
    {
        return $this->hasMany(TestsListanegra::class, 'ID_Test');
    }

    public function tests__reactivos()
    {
        return $this->hasMany(TestsReactivo::class, 'ID_Test');
    }

    public function tests__usuarios()
    {
        return $this->hasMany(TestsUsuario::class, 'ID_Test');
    }
}
