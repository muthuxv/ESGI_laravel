<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string $text
 * @property int|null $id_conversation
 * @property Carbon|null $createAt
 * @property int|null $id_user
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'Message';
	public $timestamps = false;

	protected $casts = [
		'id_conversation' => 'int',
		'id_user' => 'int'
	];

	protected $dates = [
		'createAt'
	];

	protected $fillable = [
		'text',
		'id_conversation',
		'createAt',
		'id_user'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
