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
 * @property int|null $id_user
 * 
 * @property Post|null $post
 * @property User|null $user
 *
 * @package App\Models
 */
class Commentaire extends Model
{
	protected $table = 'Commentaire';
	public $timestamps = false;

	protected $casts = [
		'id_post' => 'int',
		'id_user' => 'int'
	];

	protected $dates = [
		'posterA'
	];

	protected $fillable = [
		'texte',
		'posterA',
		'id_post',
		'id_user'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'id_post');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
