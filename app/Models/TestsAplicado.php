<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsAplicado
 *
 * @property int $id
 * @property int $ID_Integrante
 * @property int|null $ID_Grupo
 * @property int $ID_Generado
 * @property Carbon $Aplicado
 * @property int $Tiempo
 * @property int $intento
 * @property string|null $Comentarios
 * @property int|null $ID_Test
 *
 * @property TestsGenerado $tests_generado
 * @property TestsGrupo $tests_grupo
 * @property User $user
 * @property TestsTest $tests_test
 * @property Collection|TestsRespuestum[] $tests__respuesta
 *
 * @package App\Models
 */
class TestsAplicado extends Model
{

    protected $table = 'tests__aplicado';

    public $timestamps = false;

    protected $casts = [
        'ID_Integrante' => 'int',
        'ID_Grupo' => 'int',
        'ID_Generado' => 'int',
        'Tiempo' => 'int',
        'intento' => 'int',
        'ID_Test' => 'int'
    ];

    protected $dates = [
        'Aplicado'
    ];

    protected $fillable = [
        'ID_Integrante',
        'ID_Grupo',
        'ID_Generado',
        'Aplicado',
        'Tiempo',
        'intento',
        'Comentarios',
        'ID_Test'
    ];

    public function tests_generado()
    {
        return $this->belongsTo(TestsGenerado::class, 'ID_Generado');
    }

    public function tests_grupo()
    {
        return $this->belongsTo(TestsGrupo::class, 'ID_Grupo');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Integrante');
    }

    public function tests_test()
    {
        return $this->belongsTo(TestsTest::class, 'ID_Test');
    }

    public function tests__respuesta()
    {
        return $this->hasMany(TestsRespuestum::class, 'ID_Test_hecho');
    }
}
