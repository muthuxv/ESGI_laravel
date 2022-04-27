<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string $text
 * @property int|null $id_conversation
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'Message';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_conversation' => 'int'
	];

	protected $fillable = [
		'text',
		'id_conversation'
	];
}
