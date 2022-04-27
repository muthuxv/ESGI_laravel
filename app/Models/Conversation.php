<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conversation
 * 
 * @property int $id
 * @property int $id_user1
 * @property int $id_user2
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Conversation extends Model
{
	protected $table = 'conversation';
	public $timestamps = false;

	protected $casts = [
		'id_user1' => 'int',
		'id_user2' => 'int'
	];

	protected $fillable = [
		'id_user1',
		'id_user2'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user2');
	}
}
