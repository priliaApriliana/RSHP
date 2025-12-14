<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idreservasi_dokter',
        'dokter_pemeriksa'
    ];

     // Relasi ke TemuDokter (melalui idreservasi_dokter)
    public function temu()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
    
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relasi ke dokter pemeriksa (melalui role_user)
    public function dokterPemeriksa()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

}
