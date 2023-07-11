<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsOder
 * 
 * @property int $id_details_oder
 * @property int $id_payment
 * @property int $id_delivery
 * @property int $quantity
 * @property int|null $total
 * @property Carbon|null $created_at
 * @property int $id_oder
 * @property int $id_shoes
 * @property string|null $color
 * @property int|null $size
 * 
 * @property Delivery $delivery
 * @property Oder $oder
 * @property Payment $payment
 * @property Shoe $shoe
 *
 * @package App\Models
 */
class DetailsOder extends Model
{
	protected $table = 'details_oders';
	protected $primaryKey = 'id_details_oder';
	public $timestamps = false;

	protected $casts = [
		'id_payment' => 'int',
		'id_delivery' => 'int',
		'quantity' => 'int',
		'total' => 'int',
		'id_oder' => 'int',
		'id_shoes' => 'int',
		'size' => 'int'
	];

	protected $fillable = [
		'id_payment',
		'id_delivery',
		'quantity',
		'total',
		'id_oder',
		'id_shoes',
		'color',
		'size'
	];

	public function delivery()
	{
		return $this->belongsTo(Delivery::class, 'id_delivery');
	}

	public function oder()
	{
		return $this->belongsTo(Oder::class, 'id_oder');
	}

	public function payment()
	{
		return $this->belongsTo(Payment::class, 'id_payment');
	}

	public function shoe()
	{
		return $this->belongsTo(Shoe::class, 'id_shoes');
	}
}
