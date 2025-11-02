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

    protected $fillable = ['nama', 'email', 'password'];

    // Relasi many-to-many ke Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status'); // kalau kamu ingin akses kolom 'status'
    }

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class, 'iduser', 'iduser');
    }
    
}
