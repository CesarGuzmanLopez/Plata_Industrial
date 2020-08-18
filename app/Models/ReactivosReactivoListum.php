<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReactivosReactivoListum
 * 
 * @property int $ID_Lista_Reactivo
 * @property int $ID_Reactivo
 * 
 * @property ReactivosListasReactivo $reactivos_listas_reactivo
 * @property ReactivosReactivo $reactivos_reactivo
 *
 * @package App\Models
 */
class ReactivosReactivoListum extends Model
{
	protected $table = 'reactivos__reactivo_lista';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_Lista_Reactivo' => 'int',
		'ID_Reactivo' => 'int'
	];

	public function reactivos_listas_reactivo()
	{
		return $this->belongsTo(ReactivosListasReactivo::class, 'ID_Lista_Reactivo');
	}

	public function reactivos_reactivo()
	{
		return $this->belongsTo(ReactivosReactivo::class, 'ID_Reactivo');
	}
}
