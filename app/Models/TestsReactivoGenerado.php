<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsReactivoGenerado
 *
 * @property int $ID_Test_Generado
 * @property int $ID_Reactivo
 * @property string|null $Data_1
 * @property string|null $Data_2
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TestsReactivo $tests_reactivo
 * @property TestsGenerado $tests_generado
 *
 * @package App\Models
 */
class TestsReactivoGenerado extends Model
{

    protected $table = 'tests__reactivo_generado';

    public $incrementing = false;

    protected $casts = [
        'ID_Test_Generado' => 'int',
        'ID_Reactivo' => 'int'
    ];

    protected $fillable = [
        'Data_1',
        'Data_2'
    ];

    public function tests_reactivo()
    {
        return $this->belongsTo(TestsReactivo::class, 'ID_Reactivo');
    }

    public function tests_generado()
    {
        return $this->belongsTo(TestsGenerado::class, 'ID_Test_Generado');
    }
}
