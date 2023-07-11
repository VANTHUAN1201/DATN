<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsShoe
 * 
 * @property int $id_details_shoes
 * @property int $id_shoes
 * @property int $quantity
 * @property string|null $context
 * @property string|null $title
 * @property Carbon $created_at
 * @property string|null $created_by
 * @property string|null $update_by
 * 
 * @property Shoe $shoe
 * @property Collection|DetailsColorShoe[] $details_color_shoes
 * @property Collection|DetailsImagesShoe[] $details_images_shoes
 * @property Collection|DetailsSizeShoe[] $details_size_shoes
 *
 * @package App\Models
 */
class DetailsShoe extends Model
{
	protected $table = 'details_shoes';
	protected $primaryKey = 'id_details_shoes';
	public $timestamps = false;

	protected $casts = [
		'id_shoes' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'id_shoes',
		'quantity',
		'context',
		'title',
		'created_by',
		'update_by'
	];

	public function shoe()
	{
		return $this->belongsTo(Shoe::class, 'id_shoes');
	}

	public function details_color_shoes()
	{
		return $this->hasMany(DetailsColorShoe::class, 'id_details_shoes');
	}

	public function details_images_shoes()
	{
		return $this->hasMany(DetailsImagesShoe::class, 'id_details_shoes');
	}

	public function details_size_shoes()
	{
		return $this->hasMany(DetailsSizeShoe::class, 'id_details_shoes');
	}
}
