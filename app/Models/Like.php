<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * 
 * @property int $id_post
 * @property int $id_user
 * @property Carbon|null $likedAt
 * 
 * @property User $user
 * @property Post $post
 *
 * @package App\Models
 */
class Like extends Model
{
	protected $table = 'Like';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_post' => 'int',
		'id_user' => 'int'
	];

	protected $dates = [
		'likedAt'
	];

	protected $fillable = [
		'likedAt'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function post()
	{
		return $this->belongsTo(Post::class, 'id_post');
	}
}
