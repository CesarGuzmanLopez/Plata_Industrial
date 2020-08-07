<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MembresiasUsuario
 *
 * @property int $ID_Usuario
 * @property int $ID_Membrecia
 * @property string $Numero_Membrecia
 * @property Carbon $Inicio
 * @property Carbon $Fin
 * @property int|null $ID_tiket
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property MembresiasMembresium $membresias_membresium
 * @property MembresiasTiket $membresias_tiket
 * @property User $user
 *
 * @package App\Models
 */
class MembresiasUsuario extends Model
{

    protected $table = 'membresias__usuario';

    public $incrementing = false;

    protected $casts = [
        'ID_Usuario' => 'int',
        'ID_Membrecia' => 'int',
        'ID_tiket' => 'int'
    ];

    protected $dates = [
        'Inicio',
        'Fin'
    ];

    protected $fillable = [
        'Numero_Membrecia',
        'Inicio',
        'Fin',
        'ID_tiket'
    ];

    public function membresias_membresium()
    {
        return $this->belongsTo(MembresiasMembresium::class, 'ID_Membrecia');
    }

    public function membresias_tiket()
    {
        return $this->belongsTo(MembresiasTiket::class, 'ID_tiket');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
