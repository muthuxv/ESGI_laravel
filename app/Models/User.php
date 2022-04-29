<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo',
        'name',
        'lastname',
        'email',
        'password',
        'id_media'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**ashboar
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function medium()
    {
        return $this->belongsTo(Medium::class, 'id_media');
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'abonne');
    }

    public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'id_user');
	}

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_user');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'id_user2');
    }
}
