<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;
    protected $table = 'homestay';
    protected $primaryKey = 'id_homestay';

    protected $fillable = [
        'id_homestay',
        'nama_homestay',
        'alamat',
        'jarak_ke_yarsi_mobil',
        'jarak_ke_yarsi_motor',
        'jarak_ke_yarsi_jk',
        'ipl',
        'listrik',
        'wifi',
        'kelebihan',
        'kekurangan',
        'harga',
        'created_at',
        'updated_at'
    ];

    public function rincian()
    {
        return $this->hasOne(Rincian::class, 'id_homestay');
    }

    protected $casts = [
        'id_homestay' => 'string',
    ];
}
