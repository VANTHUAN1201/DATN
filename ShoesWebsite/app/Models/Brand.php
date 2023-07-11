<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * 
 * @property int $id_brand
 * @property string $brandname
 * @property Carbon $created_at
 * @property string|null $created_by
 * @property string|null $update_by
 * 
 * @property Collection|Shoe[] $shoes
 *
 * @package App\Models
 */
class Brand extends Model
{
	protected $table = 'brands';
	protected $primaryKey = 'id_brand';
	public $timestamps = false;

	protected $fillable = [
		'brandname',
		'created_by',
		'update_by'
	];

	public function shoes()
	{
		return $this->hasMany(Shoe::class, 'id_brand');
	}
}
