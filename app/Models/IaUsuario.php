<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IaUsuario
 *
 * @property int $id
 * @property int|null $ID_GradoAcademico
 * @property int $ID_Usuario
 * @property string $Red_Neuronal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TgGradosAcademico $tg_grados_academico
 * @property User $user
 * @property IaBusqueda $ia_busqueda
 * @property Collection|IaTemasIntere[] $ia__temas_interes
 * @property Collection|IaTemasRecomendado[] $ia__temas_recomendados
 * @property Collection|IaTemasRevisado[] $ia__temas_revisados
 *
 * @package App\Models
 */
class IaUsuario extends Model
{

    protected $table = 'ia__usuario';

    protected $casts = [
        'ID_GradoAcademico' => 'int',
        'ID_Usuario' => 'int'
    ];

    protected $fillable = [
        'ID_GradoAcademico',
        'ID_Usuario',
        'Red_Neuronal'
    ];

    public function tg_grados_academico()
    {
        return $this->belongsTo(TgGradosAcademico::class, 'ID_GradoAcademico');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function ia_busqueda()
    {
        return $this->hasOne(IaBusqueda::class, 'ID_IA');
    }

    public function ia__temas_interes()
    {
        return $this->hasMany(IaTemasIntere::class, 'ID_IA');
    }

    public function ia__temas_recomendados()
    {
        return $this->hasMany(IaTemasRecomendado::class, 'ID_IA');
    }

    public function ia__temas_revisados()
    {
        return $this->hasMany(IaTemasRevisado::class, 'ID_IA');
    }
}
