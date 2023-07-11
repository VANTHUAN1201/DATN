<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 * 
 * @property int $id_color
 * @property string $color_name
 * @property Carbon $created_at
 * 
 * @property Collection|DetailsColorShoe[] $details_color_shoes
 *
 * @package App\Models
 */
class Color extends Model
{
	protected $table = 'color';
	protected $primaryKey = 'id_color';
	public $timestamps = false;

	protected $fillable = [
		'color_name'
	];

	public function details_color_shoes()
	{
		return $this->hasMany(DetailsColorShoe::class, 'id_color');
	}
}
