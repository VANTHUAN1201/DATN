<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsColorShoe
 *
 * @property int $id_details_shoes
 * @property int $id_color
 * @property int|null $quantity_color
 * @property Carbon $created_at
 *
 * @property DetailsShoe $details_shoe
 * @property Color $color
 *
 * @package App\Models
 */
class DetailsColorShoe extends Model
{
	protected $table = 'details_color_shoes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_details_shoes' => 'int',
		'id_color' => 'int',
		'quantity_color' => 'int'
	];

	protected $fillable = [
		'quantity_color',
        'id_details_shoes',
        'id_color'
	];

	public function details_shoe()
	{
		return $this->belongsTo(DetailsShoe::class, 'id_details_shoes');
	}

	public function color()
	{
		return $this->belongsTo(Color::class, 'id_color');
	}
}
