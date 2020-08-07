<?php
/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaginasMenu
 *
 * @property int $id
 * @property string $Nombre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|PaginasMenuItem[] $paginas__menu_items
 *
 * @package App\Models
 */
class PaginasMenu extends Model
{

    protected $table = 'paginas__menu';

    protected $fillable = [
        'Nombre'
    ];

    public function paginas__menu_items()
    {
        return $this->hasMany(PaginasMenuItem::class, 'ID_Menu');
    }
}
