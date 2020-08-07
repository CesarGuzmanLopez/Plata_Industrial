<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosOpcione
 *
 * @property int $id
 * @property string $Enunciado1
 * @property string|null $Datos1
 * @property string $Enunciado2
 * @property string|null $Datos2
 *
 * @property Collection|ReactivosReactivosOpcione[] $reactivos__reactivos_opciones
 * @property Collection|TestsRespuestum[] $tests__respuesta
 *
 * @package App\Models
 */
class ReactivosOpcione extends Model
{

    protected $table = 'reactivos__opciones';

    public $timestamps = false;

    protected $fillable = [
        'Enunciado1',
        'Datos1',
        'Enunciado2',
        'Datos2'
    ];

    public function reactivos__reactivos_opciones()
    {
        return $this->hasMany(ReactivosReactivosOpcione::class, 'ID_Opcion');
    }

    public function tests__respuesta()
    {
        return $this->hasMany(TestsRespuestum::class, 'ID_Respuesta');
    }
}
