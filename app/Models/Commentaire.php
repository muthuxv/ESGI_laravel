<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commentaire
 * 
 * @property int $id
 * @property string|null $texte
 * @property Carbon|null $posterA
 * @property int|null $id_post
 * 
 * @property Post|null $post
 *
 * @package App\Models
 */
class Commentaire extends Model
{
	protected $table = 'Commentaire';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_post' => 'int'
	];

	protected $dates = [
		'posterA'
	];

	protected $fillable = [
		'texte',
		'posterA',
		'id_post'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'id_post');
	}
}
