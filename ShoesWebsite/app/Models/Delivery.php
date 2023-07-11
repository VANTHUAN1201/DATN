<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Delivery
 * 
 * @property int $id_delivery
 * @property string $delivery_name
 * @property Carbon $created_at
 * 
 * @property Collection|DetailsOder[] $details_oders
 *
 * @package App\Models
 */
class Delivery extends Model
{
	protected $table = 'delivery';
	protected $primaryKey = 'id_delivery';
	public $timestamps = false;

	protected $fillable = [
		'delivery_name'
	];

	public function details_oders()
	{
		return $this->hasMany(DetailsOder::class, 'id_delivery');
	}
}
