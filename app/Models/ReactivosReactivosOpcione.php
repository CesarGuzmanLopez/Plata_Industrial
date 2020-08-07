<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosReactivosOpcione
 *
 * @property int $ID_Reactivo
 * @property int $ID_Opcion
 * @property float $valor
 *
 * @property ReactivosOpcione $reactivos_opcione
 * @property ReactivosReactivo $reactivos_reactivo
 *
 * @package App\Models
 */
class ReactivosReactivosOpcione extends Model
{

    protected $table = 'reactivos__reactivos_opciones';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ID_Reactivo' => 'int',
        'ID_Opcion' => 'int',
        'valor' => 'float'
    ];

    protected $fillable = [
        'valor'
    ];

    public function reactivos_opcione()
    {
        return $this->belongsTo(ReactivosOpcione::class, 'ID_Opcion');
    }

    public function reactivos_reactivo()
    {
        return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
    }
}
