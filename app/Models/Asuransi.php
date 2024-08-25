<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asuransi extends Model
{
    use HasFactory;
    protected $table = 'asuransi';
    protected $primaryKey = 'id_asuransi';


    protected $fillable = [
        'id_asuransi',
        'nama_asuransi',
        'harga'
    ];

    public function rincian()
    {
        return $this->hasOne(Rincian::class, 'id_asuransi');
    }

    protected $casts = [
        'id_asuransi' => 'string',
    ];
}

