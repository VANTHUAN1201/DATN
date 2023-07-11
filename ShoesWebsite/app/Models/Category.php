<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id_category
 * @property string|null $category_name
 * @property Carbon $created_at
 * @property string|null $created_by
 * @property string|null $update_by
 * 
 * @property Collection|Shoe[] $shoes
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id_category';
	public $timestamps = false;

	protected $fillable = [
		'category_name',
		'created_by',
		'update_by'
	];

	public function shoes()
	{
		return $this->hasMany(Shoe::class, 'id_category');
	}
}
