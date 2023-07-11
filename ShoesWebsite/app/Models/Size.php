<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Size
 * 
 * @property int $id_size
 * @property int $size_name
 * @property Carbon $created_at
 * 
 * @property Collection|DetailsSizeShoe[] $details_size_shoes
 *
 * @package App\Models
 */
class Size extends Model
{
	protected $table = 'size';
	protected $primaryKey = 'id_size';
	public $timestamps = false;

	protected $casts = [
		'size_name' => 'int'
	];

	protected $fillable = [
		'size_name'
	];

	public function details_size_shoes()
	{
		return $this->hasMany(DetailsSizeShoe::class, 'id_size');
	}
}
