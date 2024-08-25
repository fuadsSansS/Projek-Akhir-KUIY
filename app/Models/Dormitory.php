<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;
    protected $table = 'dormitory';
    protected $primaryKey = 'id_dormitory';

    protected $fillable = [
        'id_dormitory',
        'nama_dormitory',
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
        return $this->hasOne(Rincian::class, 'id_dormitory');
    }

    protected $casts = [
        'id_dormitory' => 'string',
    ];
}
