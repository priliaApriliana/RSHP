<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $inscrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'idpemilik',
        'no_wa',
        'alamat',
        'iduser',
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    //relasi ke tabel pet
    public function pet()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}
