<?php

/**
 * @Author: Cesar Gerardo Guzman Lopez
 */
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class PasswordReset extends Model
{

    protected $table = 'password_resets';

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $hidden = [
        'token'
    ];

    protected $fillable = [
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
