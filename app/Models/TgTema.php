<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TgTema
 * @property string $Descripcion

 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Usuario_Creador
 * @property bool $Premium
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|IaTemasRecomendado[] $ia__temas_recomendados
 * @property Collection|IaTemasRevisado[] $ia__temas_revisados
 * @property Collection|ReactivosReactivo[] $reactivos__reactivos
 * @property Collection|TgCursoTemasDifuso[] $tg__curso_temas_difusos
 * @property Collection|TgSubtemasDifuso[] $tg__subtemas_difusos
 * @method  Collection|TgTema get()
 * @method  TgTema first()

 * @package App\Models
 */
class TgTema extends Model
{

    protected $table = 'tg__temas';

    protected $casts = [
        'ID_Usuario_Creador' => 'int',
        'Premium' => 'bool'
    ];

    protected $fillable = [
        'Nombre',
        'ID_Usuario_Creador',
        'Premium',
        'Descripcion'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario_Creador');
    }

    public function ia__temas_recomendados()
    {
        return $this->hasMany(IaTemasRecomendado::class, 'ID_Tema_Recomendado');
    }

    public function ia__temas_revisados()
    {
        return $this->hasMany(IaTemasRevisado::class, 'ID_Tema_Visto');
    }

    public function reactivos__reactivos()
    {
        return $this->hasMany(ReactivosReactivo::class, 'ID_Tema');
    }

    public function tg__curso_temas_difusos()
    {
        return $this->hasMany(TgCursoTemasDifuso::class, 'ID_Tema');
    }

    public function tg__subtemas_difusos()
    {
        return $this->hasMany(TgSubtemasDifuso::class, 'ID_Tema');
    }
}
