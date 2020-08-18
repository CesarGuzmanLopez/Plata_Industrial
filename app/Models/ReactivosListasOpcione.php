<?php


/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosListasOpcione
 * 
 * @property int $id
 * @property string $Nombre
 * @property int|null $ID_Creador
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|ReactivosOpcionesListum[] $reactivos__opciones_lista
 *
 * @package App\Models
 */
class ReactivosListasOpcione extends Model
{
	protected $table = 'reactivos__listas_opciones';

	protected $casts = [
		'ID_Creador' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'ID_Creador'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'ID_Creador');
	}

	public function reactivos__opciones_lista()
	{
		return $this->hasMany(ReactivosOpcionesListum::class, 'ID_Lista_opcion');
	}
}
