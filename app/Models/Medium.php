<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Medium
 * 
 * @property int $id
 * @property string|null $path
 * 
 * @property Collection|PostMedia[] $post_media
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Medium extends Model
{
	protected $table = 'Media';
	public $timestamps = false;

	protected $fillable = [
		'path'
	];

	public function post_media()
	{
		return $this->hasMany(PostMedia::class, 'id_media');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'id_media');
	}
}
