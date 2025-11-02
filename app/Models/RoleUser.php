<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'idrole',
        'status'
    ];

    //relasi ke role
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    //relasi ke user 
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    //relasi ke temudokter
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idrole_user', 'idrole_user');
    }

    //relasi ke rekam medis sebagai dokter pemeriksaan 
    public function rekamMedisDiperiksa()
    {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa', 'idrole_user');
    }

    //helper untuk mendapatkan nama dokter
    public function getNamaDokterAttribute()
    {
        return $this->user->nama ?? '-';
    }
}
