<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosPopularidad
 *
 * @property int $ID_Reactivo
 * @property int $ID_Grado
 * @property float|null $Valor
 * @property float|null $Dificultad_Alumnos
 * @property float|null $Dificultad_Creador
 * @property float|null $Dificultad_Maestros
 * @property string|null $Neuronas
 *
 * @property TgGradosAcademico $tg_grados_academico
 * @property ReactivosReactivo $reactivos_reactivo
 *
 * @package App\Models
 */
class ReactivosPopularidad extends Model
{

    protected $table = 'reactivos__popularidad';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Reactivo' => 'int',
        'ID_Grado' => 'int',
        'Valor' => 'float',
        'Dificultad_Alumnos' => 'float',
        'Dificultad_Creador' => 'float',
        'Dificultad_Maestros' => 'float'
    ];

    protected $fillable = [
        'Valor',
        'Dificultad_Alumnos',
        'Dificultad_Creador',
        'Dificultad_Maestros',
        'Neuronas'
    ];

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_Grado');
    }

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }
}
