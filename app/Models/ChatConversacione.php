<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatConversacione
 *
 * @property int $id
 * @property bool $Privado 
 *                  Me dice si el chat es privado lo puede ver otra persona o es mensaje directo
 * @property bool $Directo Si es
 * @property multilinestring $Data Mensaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|ChatMensaje[] $chat__mensajes
 * @property Collection|ChatNotificacione[] $chat__notificaciones
 * @property Collection|ChatParticipante[] $chat__participantes
 *
 * @package App\Models
 */
class ChatConversacione extends Model
{

    protected $table = 'chat__conversaciones';

    protected $casts = [
        'Privado' => 'bool',
        'Directo' => 'bool',
        'Data' => 'multilinestring'
    ];

    protected $fillable = [
        'Privado',
        'Directo',
        'Data'
    ];

    public function chat__mensajes()
    {
        return $this->hasMany(ChatMensaje::class, 'ID_Conversacion');
    }

    public function chat__notificaciones()
    {
        return $this->hasMany(ChatNotificacion::class, 'ID_Conversacion');
    }
    
    public function chat__participantes()
    {
        return $this->hasMany(ChatParticipante::class, 'ID_Conversacion');
    }
}
