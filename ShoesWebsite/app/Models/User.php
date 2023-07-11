<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 *
 * @property int $id_user
 * @property string $user_name
 * @property string $password
 * @property int|null $phone
 * @property string|null $images
 * @property int|null $role
 * @property string $email
 * @property string|null $address
 * @property Carbon $created_at
 * @property string|null $created_by
 * @property string|null $update_by
 *
 * @property Collection|Cart[] $carts
 * @property Collection|Oder[] $oders
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';
	protected $primaryKey = 'id_user';
	public $timestamps = false;

	protected $casts = [
		'phone' => 'int',
		'role' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_name',
		'password',
		'phone',
		'images',
		'role',
		'email',
		'address',
		'created_by',
		'update_by'
	];

	public function carts()
	{
		return $this->hasMany(Cart::class, 'id_users');
	}

	public function oders()
	{
		return $this->hasMany(Oder::class, 'id_user');
	}
    public function isAdmin()
    {
        return $this->role === 1;
    }
}
