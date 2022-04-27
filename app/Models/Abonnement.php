<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Abonnement
 * 
 * @property int $abonnement
 * @property int $abonne
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Abonnement extends Model
{
	protected $table = 'Abonnement';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'abonnement' => 'int',
		'abonne' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'abonne');
	}
}
