<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    use HasFactory;

    protected $table = 'rincian';
    protected $primaryKey = 'id_rincian';
    protected $fillable = [
        'id_rincian',
        'id_user',
        'id_asuransi',
        'id_keimigrasian',
        'id_homestay',
        'id_dormitory',
        'id_hotel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function asuransi()
    {
        return $this->belongsTo(Asuransi::class, 'id_asuransi');
    }

    public function keimigrasian()
    {
        return $this->belongsTo(Keimigrasian::class, 'id_keimigrasian');
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class, 'id_homestay');
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'id_dormitory');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel');
    }

    protected $casts = [
        'id_rincian' => 'string',
    ];
}
