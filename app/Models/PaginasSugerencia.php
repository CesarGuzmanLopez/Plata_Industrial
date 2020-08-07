<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaginasSugerencia
 *
 * @property int $id
 * @property string $Sugerencia
 * @property int|null $ID_Autor
 * @property int|null $ID_Revisor
 * @property bool $Estado
 * @property multilinestring|null $meta_Description
 * @property linestring|null $meta_Keywords
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class PaginasSugerencia extends Model
{

    protected $table = 'paginas__sugerencias';

    protected $casts = [
        'ID_Autor' => 'int',
        'ID_Revisor' => 'int',
        'Estado' => 'bool',
        'meta_Description' => 'multilinestring',
        'meta_Keywords' => 'linestring'
    ];

    protected $fillable = [
        'Sugerencia',
        'ID_Autor',
        'ID_Revisor',
        'Estado',
        'meta_Description',
        'meta_Keywords'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Revisor');
    }
}
