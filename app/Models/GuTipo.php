<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuTipo
 *
 * @property int $id
 * @property string $Nombre
 *
 * @property Collection|GuGrupo[] $gu__grupos
 *
 * @package App\Models
 */
class GuTipo extends Model
{

    protected $table = 'gu__tipo';

    public $timestamps = false;

    protected $fillable = [
        'Nombre'
    ];

    public function gu__grupos()
    {
        return $this->hasMany(GuGrupo::class, 'Tipo_Grupo');
    }
}
