<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuIntegrante
 *
 * @property int $ID_User
 * @property int $ID_grupo
 * @property int|null $posicion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property GuGrupo $gu_grupo
 * @property User $user
 *
 * @package App\Models
 */
class GuIntegrante extends Model
{

    protected $table = 'gu__integrantes';

    public $incrementing = false;

    protected $casts = [
        'ID_User' => 'int',
        'ID_grupo' => 'int',
        'posicion' => 'int'
    ];

    protected $fillable = [
        'posicion'
    ];

    public function gu_grupo()
    {
        return $this->belongsTo(GuGrupo::class, 'ID_grupo');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User');
    }
}
