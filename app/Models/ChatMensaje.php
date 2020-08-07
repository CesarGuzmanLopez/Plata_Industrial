<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatMensaje
 *
 * @property int $id
 * @property multilinestring $body
 * @property int $ID_Conversacion
 * @property bool $Grupal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ChatConversacione $chat_conversacione
 * @property Collection|ChatNotificacione[] $chat__notificaciones
 *
 * @package App\Models
 */
class ChatMensaje extends Model
{

    protected $table = 'chat__mensajes';

    protected $casts = [
        'body' => 'multilinestring',
        'ID_Conversacion' => 'int',
        'Grupal' => 'bool'
    ];

    protected $fillable = [
        'body',
        'ID_Conversacion',
        'Grupal'
    ];

    public function chat_conversacione()
    {
        return $this->belongsTo(ChatConversacione::class, 'ID_Conversacion');
    }

    public function chat__notificaciones()
    {
        return $this->hasMany(ChatNotificacione::class, 'ID_Mensaje');
    }
}
