<?php
/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaginasMenuItem
 *
 * @property int $id
 * @property int $ID_Menu
 * @property string $Titulo
 * @property string $url
 * @property string $target
 * @property string $Icono_clase
 * @property string $tipo
 * @property int $Order
 * @property int $ID_Item_Padre
 * @property string|null $parametros
 * @property int|null $ID_Pagina
 * @property bool $Activo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property PaginasMenuItem $paginas_menu_item
 * @property PaginasMenu $paginas_menu
 * @property PaginasPagina $paginas_pagina
 * @property Collection|PaginasMenuItem[] $paginas__menu_items
 *
 * @package App\Models
 */
class PaginasMenuItem extends Model
{

    protected $table = 'paginas__menu_items';

    protected $casts = [
        'ID_Menu' => 'int',
        'Order' => 'int',
        'ID_Item_Padre' => 'int',
        'ID_Pagina' => 'int',
        'Activo' => 'bool'
    ];

    protected $fillable = [
        'ID_Menu',
        'Titulo',
        'url',
        'target',
        'Icono_clase',
        'tipo',
        'Order',
        'ID_Item_Padre',
        'parametros',
        'ID_Pagina',
        'Activo'
    ];

    public function paginas_menu_item()
    {
        return $this->belongsTo(PaginasMenuItem::class, 'ID_Item_Padre');
    }

    public function paginas_menu()
    {
        return $this->belongsTo(PaginasMenu::class, 'ID_Menu');
    }

    public function paginas_pagina()
    {
        return $this->belongsTo(PaginasPagina::class, 'ID_Pagina');
    }

    public function paginas__menu_items()
    {
        return $this->hasMany(PaginasMenuItem::class, 'ID_Item_Padre');
    }
}
