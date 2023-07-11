<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsSizeShoe
 *
 * @property int $id_details_shoes
 * @property int $id_size
 * @property int|null $quantity_size
 * @property Carbon $created_at
 *
 * @property Size $size
 * @property DetailsShoe $details_shoe
 *
 * @package App\Models
 */
class DetailsSizeShoe extends Model
{
	protected $table = 'details_size_shoes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_details_shoes' => 'int',
		'id_size' => 'int',
		'quantity_size' => 'int'
	];

	protected $fillable = [
		'quantity_size',
        'id_details_shoes',
        'id_size'
    ];

	public function size()
	{
		return $this->belongsTo(Size::class, 'id_size');
	}

	public function details_shoe()
	{
		return $this->belongsTo(DetailsShoe::class, 'id_details_shoes');
	}
}
