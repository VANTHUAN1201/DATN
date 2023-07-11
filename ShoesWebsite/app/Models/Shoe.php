<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shoe
 * 
 * @property int $id_shoes
 * @property string $shoes_name
 * @property int $id_category
 * @property int $id_brand
 * @property int $prices_buy
 * @property int $prices_sell
 * @property string|null $images
 * @property Carbon $created_at
 * @property string|null $created_by
 * 
 * @property Brand $brand
 * @property Category $category
 * @property Collection|Cart[] $carts
 * @property Collection|DetailsOder[] $details_oders
 * @property Collection|DetailsShoe[] $details_shoes
 *
 * @package App\Models
 */
class Shoe extends Model
{
	protected $table = 'shoes';
	protected $primaryKey = 'id_shoes';
	public $timestamps = false;

	protected $casts = [
		'id_category' => 'int',
		'id_brand' => 'int',
		'prices_buy' => 'int',
		'prices_sell' => 'int'
	];

	protected $fillable = [
		'shoes_name',
		'id_category',
		'id_brand',
		'prices_buy',
		'prices_sell',
		'images',
		'created_by'
	];

	public function brand()
	{
		return $this->belongsTo(Brand::class, 'id_brand');
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_category');
	}

	public function carts()
	{
		return $this->hasMany(Cart::class, 'id_shoes');
	}

	public function details_oders()
	{
		return $this->hasMany(DetailsOder::class, 'id_shoes');
	}

	public function details_shoes()
	{
		return $this->hasMany(DetailsShoe::class, 'id_shoes');
	}
}
