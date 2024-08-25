<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $table = 'visa';
    protected $primaryKey = 'id_visa';

    protected $fillable = [
        'id_visa',
        'nama_formulir'
    ];

    protected $casts = [
        'id_visa' => 'string',
    ];
}
