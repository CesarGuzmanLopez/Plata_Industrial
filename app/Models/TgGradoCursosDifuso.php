<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TgGradoCursosDifuso
 *
 * @property int $ID_Grado
 * @property int $ID_Curso
 * @property float $valor
 *
 * @property TgCurso $tg_curso
 * @property TgGradosAcademico $tg_grados_academico
 *
 * @package App\Models
 */
class TgGradoCursosDifuso extends Model
{

    protected $table = 'tg__grado_cursos_difusos';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Grado' => 'int',
        'ID_Curso' => 'int',
        'valor' => 'float'
    ];

    protected $fillable = [
        'valor'
    ];

    public function tg_curso()
    {
        return $this->belongsTo(TgCurso::class, 'ID_Curso');
    }

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_Grado');
    }
}
