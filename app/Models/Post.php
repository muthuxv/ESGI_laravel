<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property int $id
 * @property string|null $text
 * @property Carbon|null $posterA
 * @property int $id_user
 * 
 * @property User $user
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|Like[] $likes
 * @property Collection|PostMedia[] $post_media
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'Post';
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int'
	];

	protected $dates = [
		'posterA'
	];

	protected $fillable = [
		'text',
		'posterA',
		'id_user'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'id_post');
	}

	public function likes()
	{
		return $this->hasMany(Like::class, 'id_post');
	}

	public function post_media()
	{
		return $this->hasMany(PostMedia::class, 'id_post');
	}
}
