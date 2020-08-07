<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaginasPagina
 *
 * @property int $id
 * @property string|null $Descripcion
 * @property int|null $Tipo_Pagina
 * @property int|null $ID_Usuario
 * @property string|null $TipoTexto
 * @property string|null $Url_Relativa
 * @property multilinestring $Data
 * @property string|null $Ruta
 * @property bool $Activa
 * @property multilinestring|null $meta_Description
 * @property linestring|null $meta_Keywords
 * @property int|null $ID_Rol_Permitido
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Role $role
 * @property User $user
 * @property Collection|PaginasLog[] $paginas__logs
 * @property Collection|PaginasMenuItem[] $paginas__menu_items
 *
 * @package App\Models
 */
class PaginasPagina extends Model
{

    protected $table = 'paginas__paginas';

    protected $casts = [
        'Tipo_Pagina' => 'int',
        'ID_Usuario' => 'int',
        'Data' => 'multilinestring',
        'Activa' => 'bool',
        'meta_Description' => 'multilinestring',
        'meta_Keywords' => 'linestring',
        'ID_Rol_Permitido' => 'int'
    ];

    protected $fillable = [
        'Descripcion',
        'Tipo_Pagina',
        'ID_Usuario',
        'TipoTexto',
        'Url_Relativa',
        'Data',
        'Ruta',
        'Activa',
        'meta_Description',
        'meta_Keywords',
        'ID_Rol_Permitido'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'ID_Rol_Permitido');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function paginas__logs()
    {
        return $this->hasMany(PaginasLog::class, 'ID_Pagina');
    }

    public function paginas__menu_items()
    {
        return $this->hasMany(PaginasMenuItem::class, 'ID_Pagina');
    }
}
