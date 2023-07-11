<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Oder
 * 
 * @property int $id_oders
 * @property int $id_user
 * @property Carbon $created_at
 * @property string|null $created_by
 * @property int $sub_total
 * @property int|null $condition
 * @property int|null $status
 * 
 * @property User $user
 * @property Collection|DetailsOder[] $details_oders
 *
 * @package App\Models
 */
class Oder extends Model
{
	protected $table = 'oders';
	protected $primaryKey = 'id_oders';
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int',
		'sub_total' => 'int',
		'condition' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'id_user',
		'created_by',
		'sub_total',
		'condition',
		'status'
	];
	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function details_oders()
	{
		return $this->hasMany(DetailsOder::class, 'id_oder');
	}
}
