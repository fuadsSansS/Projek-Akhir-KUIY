<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keimigrasian extends Model
{
    use HasFactory;

    protected $table = 'keimigrasian';
    protected $primaryKey = 'id_keimigrasian';


    protected $fillable = [
        'id_keimigrasian',
        'item',
        'keimigrasian',
        'kemenaker',
        'biaya_keimigrasian',
        'biaya_kemenaker',
        'total_biaya'
    ];

    public function rincian()
    {
        return $this->hasOne(Rincian::class, 'id_keimigrasian');
    }

    protected $casts = [
        'id_keimigrasian' => 'string',
    ];
}
