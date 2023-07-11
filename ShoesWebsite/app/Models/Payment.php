<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property int $id_payment
 * @property string $payment_name
 * @property Carbon $created_at
 * 
 * @property Collection|DetailsOder[] $details_oders
 *
 * @package App\Models
 */
class Payment extends Model
{
	protected $table = 'payment';
	protected $primaryKey = 'id_payment';
	public $timestamps = false;

	protected $fillable = [
		'payment_name'
	];

	public function details_oders()
	{
		return $this->hasMany(DetailsOder::class, 'id_payment');
	}
}
