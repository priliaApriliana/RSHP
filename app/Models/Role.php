<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    //nama tabel di database
    protected $table = 'role';

    //primary key
    protected $primaryKey = 'idrole';

    //Jika tidak ada created_at dan updated_at
    public $timestamps = false;

    // karena idrole TIDAK auto_increment
    public $incrementing = false; 

    //Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'idrole',
        'nama_role'
    ];

    //relasi ke tabel user (many to many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('status');
    }

    public function RoleUser()
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }

}
