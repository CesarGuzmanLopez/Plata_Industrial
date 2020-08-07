<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestsUsuario
 *
 * @property int $ID_Usuario
 * @property int $ID_Test
 * @property string|null $Descripcion
 * @property int $intentos
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TestsTest $tests_test
 * @property User $user
 *
 * @package App\Models
 */
class TestsUsuario extends Model
{

    protected $table = 'tests__usuario';

    public $incrementing = false;

    protected $casts = [
        'ID_Usuario' => 'int',
        'ID_Test' => 'int',
        'intentos' => 'int'
    ];

    protected $fillable = [
        'Descripcion',
        'intentos'
    ];

    public function tests_test()
    {
        return $this->belongsTo(TestsTest::class, 'ID_Test');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
