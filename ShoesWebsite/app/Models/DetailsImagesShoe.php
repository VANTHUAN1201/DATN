<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailsImagesShoe
 *
 * @property int $id_details_shoes
 * @property int $id_images
 * @property Carbon $created_at
 *
 * @property DetailsShoe $details_shoe
 * @property Image $image
 *
 * @package App\Models
 */
class DetailsImagesShoe extends Model
{
	protected $table = 'details_images_shoes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_details_shoes' => 'int',
		'id_images' => 'int'
	];
    protected $fillable=[
        'id_details_shoes',
        'id_images'
    ];

	public function details_shoe()
	{
		return $this->belongsTo(DetailsShoe::class, 'id_details_shoes');
	}

	public function image()
	{
		return $this->belongsTo(Image::class, 'id_images');
	}
}
