<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosReactivo
 *
 * @property int $id
 * @property int|null $ID_Grupo_Reactivos
 * @property int|null $ID_Tema
 * @property int|null $ID_Tema_Interes
 * @property int|null $ID_Creador
 * @property string $Nombre
 * @property string|null $Enunciado
 * @property string|null $Datos
 *
 * @property User $user
 * @property ReactivosGruposTipo $reactivos_grupos_tipo
 * @property TgTema $tg_tema
 * @property ReactivosTemasInterest $reactivos_temas_interest
 * @property ReactivosDatosExtra $reactivos_datos_extra
 * @property Collection|ReactivosEstadistica[] $reactivos__estadisticas
 * @property Collection|ReactivosPopularidad[] $reactivos__popularidads
 * @property Collection|ReactivosReactivosOpcione[] $reactivos__reactivos_opciones
 * @property Collection|ReactivosRetroalimentacion[] $reactivos__retroalimentacions
 * @property Collection|TestsReactivo[] $tests__reactivos
 *
 * @package App\Models
 */
class ReactivosReactivo extends Model
{

    protected $table = 'reactivos__reactivos';

    public $timestamps = false;

    protected $casts = [
        'ID_Grupo_Reactivos' => 'int',
        'ID_Tema' => 'int',
        'ID_Tema_Interes' => 'int',
        'ID_Creador' => 'int'
    ];

    protected $fillable = [
        'ID_Grupo_Reactivos',
        'ID_Tema',
        'ID_Tema_Interes',
        'ID_Creador',
        'Nombre',
        'Enunciado',
        'Datos'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Creador');
    }

    public function reactivos_grupos_tipo()
    {
        return $this->belongsTo(ReactivosGruposTipo::class, 'ID_Grupo_Reactivos');
    }

    public function tg_tema()
    {
        return $this->belongsTo(TgTema::class, 'ID_Tema');
    }

    public function reactivos_temas_interest()
    {
        return $this->belongsTo(ReactivosTemasInterest::class, 'ID_Tema_Interes');
    }

    public function reactivos_datos_extra()
    {
        return $this->hasOne(ReactivosDatosExtra::class, 'ID_Reactivo');
    }

    public function reactivos__estadisticas()
    {
        return $this->hasMany(ReactivosEstadistica::class, 'ID_Reactivo');
    }

    public function reactivos__popularidads()
    {
        return $this->hasMany(ReactivosPopularidad::class, 'ID_Reactivo');
    }

    public function reactivos__reactivos_opciones()
    {
        return $this->hasMany(ReactivosReactivosOpcione::class, 'ID_Reactivo');
    }

    public function reactivos__retroalimentacions()
    {
        return $this->hasMany(ReactivosRetroalimentacion::class, 'ID_Reactivo');
    }

    public function tests__reactivos()
    {
        return $this->hasMany(TestsReactivo::class, 'ID_Reactivo');
    }
}
