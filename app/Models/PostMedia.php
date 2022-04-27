<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostMedia
 * 
 * @property int $id_post
 * @property int $id_media
 * 
 * @property Post $post
 * @property Medium $medium
 *
 * @package App\Models
 */
class PostMedia extends Model
{
	protected $table = 'PostMedia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_post' => 'int',
		'id_media' => 'int'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'id_post');
	}

	public function medium()
	{
		return $this->belongsTo(Medium::class, 'id_post');
	}
}
