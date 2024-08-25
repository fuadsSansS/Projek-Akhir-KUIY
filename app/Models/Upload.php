<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $table = 'upload';
    protected $primaryKey = 'id_upload';

    protected $fillable = [
        'id_upload',
        'id_parent',
        'file_name',
        'file_type',
        'created_at'
    ];
}
