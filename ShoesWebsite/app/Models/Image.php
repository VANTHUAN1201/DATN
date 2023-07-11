<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * @property int $id_images
 * @property string $images
 * @property Carbon $created_at
 * 
 * @property Collection|DetailsImagesShoe[] $details_images_shoes
 *
 * @package App\Models
 */
class Image extends Model
{
	protected $table = 'images';
	protected $primaryKey = 'id_images';
	public $timestamps = false;

	protected $fillable = [
		'images'
	];

	public function details_images_shoes()
	{
		return $this->hasMany(DetailsImagesShoe::class, 'id_images');
	}
}
