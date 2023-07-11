<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id_carts
 * @property int $id_shoes
 * @property string|null $color
 * @property string|null $size
 * @property int $quantity
 * @property Carbon|null $cerated_at
 * @property int $id_users
 * 
 * @property Shoe $shoe
 * @property User $user
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'carts';
	protected $primaryKey = 'id_carts';
	public $timestamps = false;

	protected $casts = [
		'id_shoes' => 'int',
		'quantity' => 'int',
		'cerated_at' => 'datetime',
		'id_users' => 'int'
	];

	protected $fillable = [
		'id_shoes',
		'color',
		'size',
		'quantity',
		'cerated_at',
		'id_users'
	];

	public function shoe()
	{
		return $this->belongsTo(Shoe::class, 'id_shoes');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_users');
	}
}
