<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';

    protected $fillable = [
        'id_hotel',
        'nama_hotel',
        'alamat',
        'jarak_ke_yarsi_mobil',
        'jarak_ke_yarsi_motor',
        'jarak_ke_yarsi_jk',
        'kelebihan',
        'kekurangan',
        'harga',
        'created_at',
        'updated_at'
    ];

    public function rincian()
    {
        return $this->hasOne(Rincian::class, 'id_hotel');
    }

    protected $casts = [
        'id_hotel' => 'string',
    ];
}
