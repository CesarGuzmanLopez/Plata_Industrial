<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosEstadistica
 *
 * @property int $ID_Reactivo
 * @property int $ID_tipo
 * @property int $ID_Grado
 * @property float $valor
 * @property int $Numero_De_Preguntas
 * @property float $Suma_valor
 * @property float $Suma_tiempo
 *
 * @property TgGradosAcademico $tg_grados_academico
 * @property ReactivosReactivo $reactivos_reactivo
 * @property ReactivosTipo $reactivos_tipo
 *
 * @package App\Models
 */
class ReactivosEstadistica extends Model
{

    protected $table = 'reactivos__estadisticas';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Reactivo' => 'int',
        'ID_tipo' => 'int',
        'ID_Grado' => 'int',
        'valor' => 'float',
        'Numero_De_Preguntas' => 'int',
        'Suma_valor' => 'float',
        'Suma_tiempo' => 'float'
    ];

    protected $fillable = [
        'valor',
        'Numero_De_Preguntas',
        'Suma_valor',
        'Suma_tiempo'
    ];

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_Grado');
    }

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }

    public function reactivos_tipo()
    {
        return $this->belongsTo(ReactivosTipo::class, 'ID_tipo');
    }
}
