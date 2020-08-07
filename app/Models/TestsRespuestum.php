<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsRespuestum
 *
 * @property int $ID_Test_hecho
 * @property int $ID_Respuesta
 * @property string|null $Data1
 * @property string|null $Data2
 *
 * @property ReactivosOpcione $reactivos_opcione
 * @property TestsAplicado $tests_aplicado
 *
 * @package App\Models
 */
class TestsRespuestum extends Model
{

    protected $table = 'tests__respuesta';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Test_hecho' => 'int',
        'ID_Respuesta' => 'int'
    ];

    protected $fillable = [
        'Data1',
        'Data2'
    ];

    public function reactivos_opcione()
    {
        return $this->belongsTo(ReactivosOpcione::class, 'ID_Respuesta');
    }

    public function tests_aplicado()
    {
        return $this->belongsTo(TestsAplicado::class, 'ID_Test_hecho');
    }
}
