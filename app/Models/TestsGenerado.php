<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsGenerado
 *
 * @property int $id
 * @property int $ID_Test
 * @property string $DatosGenerados
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TestsTest $tests_test
 * @property Collection|TestsAplicado[] $tests__aplicados
 * @property Collection|TestsReactivoGenerado[] $tests__reactivo_generados
 *
 * @package App\Models
 */
class TestsGenerado extends Model
{

    protected $table = 'tests__generados';

    protected $casts = [
        'ID_Test' => 'int'
    ];

    protected $fillable = [
        'ID_Test',
        'DatosGenerados'
    ];

    public function tests_test()
    {
        return $this->belongsTo(TestsTest::class, 'ID_Test');
    }

    public function tests__aplicados()
    {
        return $this->hasMany(TestsAplicado::class, 'ID_Generado');
    }

    public function tests__reactivo_generados()
    {
        return $this->hasMany(TestsReactivoGenerado::class, 'ID_Test_Generado');
    }
}
