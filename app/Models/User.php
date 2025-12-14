<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    // The attributes that are mass assignable.
    protected $fillable = [
        'iduser',
        'nama', 
        'email', 
        'password',
    ];

    /**
    * The attributes that should be hidden for serialization.
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relations
     */
    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'id_user', 'iduser');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_user', 'iduser');
    }
    
}
