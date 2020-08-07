<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TgCursoTemasDifuso
 *
 * @property int $ID_Tema
 * @property int $ID_Curso
 * @property float $valor
 *
 * @property TgCurso $tg_curso
 * @property TgTema $tg_tema
 *
 * @package App\Models
 */
class TgCursoTemasDifuso extends Model
{

    protected $table = 'tg__curso_temas_difusos';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Tema' => 'int',
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

    public function tg_tema()
    {
        return $this->belongsTo(TgTema::class, 'ID_Tema');
    }
}
