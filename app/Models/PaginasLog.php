<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaginasLog
 *
 * @property int $id
 * @property string $Nombre_Evento
 * @property string $Componente
 * @property string $Accion
 * @property string $Target
 * @property int $ID_Pagina
 * @property int|null $ID_Usuario
 * @property string|null $IP
 * @property int|null $Real_ID_User
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property PaginasPagina $paginas_pagina
 * @property User $user
 *
 * @package App\Models
 */
class PaginasLog extends Model
{

    protected $table = 'paginas__logs';

    protected $casts = [
        'ID_Pagina' => 'int',
        'ID_Usuario' => 'int',
        'Real_ID_User' => 'int'
    ];

    protected $fillable = [
        'Nombre_Evento',
        'Componente',
        'Accion',
        'Target',
        'ID_Pagina',
        'ID_Usuario',
        'IP',
        'Real_ID_User'
    ];

    public function paginas_pagina()
    {
        return $this->belongsTo(PaginasPagina::class, 'ID_Pagina');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'Real_ID_User');
    }
}
