<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IaTemasRecomendado
 *
 * @property int $id
 * @property int $ID_IA
 * @property int $ID_Tema_Recomendado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property IaUsuario $ia_usuario
 * @property TgTema $tg_tema
 *
 * @package App\Models
 */
class IaTemasRecomendado extends Model
{

    protected $table = 'ia__temas_recomendados';

    protected $casts = [
        'ID_IA' => 'int',
        'ID_Tema_Recomendado' => 'int'
    ];

    protected $fillable = [
        'ID_IA',
        'ID_Tema_Recomendado'
    ];

    public function ia_usuario()
    {
        return $this->belongsTo(IaUsuario::class, 'ID_IA');
    }

    public function tg_tema()
    {
        return $this->belongsTo(TgTema::class, 'ID_Tema_Recomendado');
    }
}
